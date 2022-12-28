<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\CartCoupon;
use App\Models\Category;
use App\Models\CommonDatas;
use App\Models\Countries;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductWishlist;
use App\Rules\ValidateProduct;
use App\Rules\validateProductIdArray;
use App\Rules\ValidateProductVariant;
use App\Services\AppMailService;
use App\Services\CartServices;
use App\Services\OrderServices;
use App\Services\PaymentServices;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{

    protected $cartServices = null;
    protected $paymentServices = null;
    protected $orderServices = null;
    protected $appMailService = null;

    public function __construct(CartServices $cartServices, PaymentServices $paymentServices, OrderServices $orderServices, AppMailService $appMailService)
    {
        $this->cartServices = $cartServices;
        $this->paymentServices = $paymentServices;
        $this->orderServices = $orderServices;
        $this->appMailService = $appMailService;
    }

    public function cartInfo(Request $request)
    {
        $data = $this->cartServices->listItems();
        return returnApiResponse(true, '', [
            "cart_items" => count($data['cart_items']) ?? 0,
            "total_price" => $data['sub_total'] ?? 0,
        ]);
    }

    public function pCheck(Request $request)
    {
        $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();
        if (!$stripeConfig) {
            return returnApiResponse(false, 'Stripe configuation is not available');
        }

        $stripe = new \Stripe\StripeClient($stripeConfig->skey);

        // $dd2 = $stripe->charges->all(['limit' => 3]);

        // $dd = $stripe->charges->retrieve(
        //     'ch_3MGbD0GT0QKyhrA73nGCvWDM',
        //     []
        // );

        $dd = $stripe->paymentIntents->retrieve(
            'pi_3MGdXqGT0QKyhrA73ZXDCVGK',
            []
        );

        // $dd = $stripe->charges->search([
        // 'query' => 'payment_intent:\'pi_3MGbD0GT0QKyhrA73ufMlIHo\'',
        // ]);

        return $dd;
    }

    public function getAppData(Request $request)
    {
        $headQLatLang = CommonDatas::select(['id', 'value_1 as lat', 'value_2 as lang'])->where([['key', '=', 'head-quarters-lat-lang'], ['status', '=', '1']])->first();
        $appCurrency = CommonDatas::select(['id', 'value_1 as code', 'value_2 as name'])->where([['key', '=', 'app-currency'], ['status', '=', '1']])->first();
        $data = [
            'app' => [
                'head_quarters' => [
                    'lat' => $headQLatLang ? $headQLatLang->lat : null,
                    'lang' => $headQLatLang ? $headQLatLang->lang : null,
                ],
                'currency' => [
                    'code' => $appCurrency ? $appCurrency->code : null,
                    'name' => $appCurrency ? $appCurrency->name : null,
                ],
                'address_types' => CommonDatas::select(['value_1 as key', 'value_2 as label'])
                    ->where([['key', '=', 'address_types'], ['status', '=', '1']])->orderBy('value_2')->get(),
            ],
        ];

        return returnApiResponse(true, '', $data);
    }

    public function listCategories(Request $request)
    {
        $data = Category::select('id', 'name', 'long_name', 'image', 'banner_image')->where('parent_id', 0)->activeOnly();
        $data->map(function ($row) {

            $row['long_name'] = empty($row->long_name) ? $row->name : $row->long_name;
            $row['image'] = $row->formatedimageurl;
            $row['banner_image'] = $row->formatedbanner_imageurl;
            $subCategories = Category::select('id', 'name', 'image')->where('parent_id', $row->id)->activeOnly();

            $subCategories->map(function ($sRow) {
                $sRow['image'] = $sRow->formatedimageurl;
            });

            $row['subCategories'] = $subCategories;
            return $row;
        });

        return returnApiResponse(true, '', $data);
    }

    public function listBrands(Request $request)
    {
        return returnApiResponse(true, '', Brand::select(['id', 'name'])->activeOnly());
    }

    public function productDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required'],
            'user_id' => ['integer'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $productId = $request->product_id;
        $userId = $request->user_id;

        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1')
                ->orderBy('price');
        }, 'images' => function ($query) {
            $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
        }])->where([['id', '=', $productId], ['status', '=', '1']])->first();

        if ($data) {

            $data->supplier_name = !empty($data->user_id) ? $data->supplier->name : null;
            $data->category_name = Category::find($data->category_id)->name;
            $data->brand_name = !empty($data->brand_id) ? Brand::find($data->brand_id)->name : '';
            $data->cover_image = $data->formatedcoverimageurl;
            $data->is_added_wishlist = !empty($userId) ? ProductWishlist::where([
                'user_id' => $userId,
                'product_id' => $data->id,
            ])->exists() : false;

            $data->images = $data->images->map(function ($img) {

                $img['file_name'] = $img->formatedimageurl;

                unset($img['product_id']);
                return $img;
            });

            $data->variants = $data->variants->map(function ($var) use ($userId) {
                $var['name'] = $var->name . ' ' . $var->unit->name;

                $cart_quantity = !empty($userId) ? Cart::where([['user_id', '=', $userId], ['product_id', '=', $var['product_id']], ['variant_id', '=', $var['id']]])->first() : [];
                $var['cart_quantity'] = $cart_quantity ? $cart_quantity->quantity : 0;

                unset($var['product_id']);
                unset($var['unit_id']);
                unset($var['unit']);
                return $var;
            });

            $packageOptions = !empty($data->category->package_options) ? unserialize($data->category->package_options) : null;
            $data->package_options = !empty($packageOptions) ? $packageOptions : null;

            unset($data->supplier);
            unset($data->category);
        }

        return returnApiResponse(!empty($data) ? true : false, !empty($data) ? '' : 'Product is not available', !empty($data) ? $data : null);
    }

    public function lastMinuteItems(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ids' => ['sometimes', new validateProductIdArray],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $frequentItems = OrderItem::select('product_id', DB::raw('sum(quantity) as sale_count'))->groupBy('product_id')
            ->orderBy('sale_count', 'desc')->inRandomOrder()->limit(20)->get();

        $productIds = !empty($frequentItems) ? $frequentItems->pluck(['product_id']) : [];

        $products = Product::select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }]);

        if (count($productIds) > 0) {
            $products = $products->whereIn('id', $productIds);
        } else {
            $products = $products->inRandomOrder()->limit(20);
        }

        $products = $products->activeOnly();

        $productsByVariants = [];
        // $products = $products->map(function ($row) use($productsByVariants) {
        //     $row['cover_image'] = !empty($row->cover_image) ? url('storage/' . $row->cover_image) : '';

        //     foreach($row->variants as $item){

        //         $itemArray = [
        //             'variant' => $item->id
        //         ];

        //         array_push($productsByVariants,$itemArray);
        //     }

        //     return $row;
        // });

        foreach ($products as $key => $product) {
            foreach ($product->variants as $variant) {

                $itemArray = [
                    'id' => $product->id,
                    'code' => $product->code,
                    'name' => $product->name,
                    'cover_image' => $product->formatedcoverimageurl,
                ];
                $itemArray['variant'] = [
                    'id' => $variant->id,
                    'name' => $variant->name . ' ' . $variant->unit->name,
                    'price' => $variant->price,
                ];
                array_push($productsByVariants, $itemArray);
            }
        }

        $productsByVariants = count($productsByVariants) > 20 ? collect($productsByVariants)->random(20) : $productsByVariants;

        return returnApiResponse(true, '', $productsByVariants);

    }

    public function listProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'user_id' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $paginateCount = 20;
        $page = $request->has('page') ? $request->page : 1;
        $limitCount = !in_array($page, [0, 1]) ? $paginateCount * ($request->page - 1) : 0;

        $category = Category::select(['id', 'name', 'long_name', 'image', 'banner_image'])->find($request->category_id);
        $data = [];
        $userId = $request->user_id;

        if ($category) {

            $category->long_name = empty($category->long_name) ? $category->name : $category->long_name;
            $category->image = $category->formatedimageurl;
            $category->banner_image = $category->formatedbannerimageurl;

            $paginateData = Product::select('id')
                ->where('category_id', $request->category_id)
                ->offset(($limitCount + $paginateCount))
                ->limit($paginateCount)
                ->activeOnly()->count();

            $data = Product::select('id', 'code', 'name', 'cover_image',
                'description')->with(['variants' => function ($query) {
                $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
            }, 'images' => function ($query) {
                $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
            }])
                ->where('category_id', $request->category_id)
                ->offset($limitCount)
                ->limit($paginateCount)
                ->activeOnly();

            $data = $data->map(function ($row) use ($userId) {

                $row['cover_image'] = $row->formatedcoverimageurl;

                $row['images'] = $row['images']->map(function ($img) {

                    $img['file_name'] = $img->formatedimageurl;
                    unset($img['product_id']);
                    return $img;
                });

                $row['variants'] = $row['variants']->map(function ($var) {
                    $var['name'] = $var->name . $var->unit->name;
                    unset($var['product_id']);
                    unset($var['unit_id']);
                    unset($var['unit']);
                    return $var;
                });

                unset($row['supplier']);
                return $row;
            });

        }

        return returnApiResponse((!count($data) ? false : true), '', [
            'is_last_page' => $paginateData ? false : true,
            'category' => $category,
            'products' => $data,
        ]);
    }

    public function listCartItems(Request $request)
    {
        return returnApiResponse(true, '', $this->cartServices->listItems());
    }

    public function addItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => [
                'required',
                'alpha',
                Rule::in(['add', 'remove']),
            ],
            'product_id' => [
                'required',
                'integer',
                new ValidateProduct,
            ],
            'variant_id' => [
                'required',
                'integer',
                new ValidateProductVariant($request->product_id),
            ],
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $quantity = 1;
        $isFound = Cart::where([
            ['user_id', '=', auth()->id()],
            ['product_id', '=', $request->product_id],
            ['variant_id', '=', $request->variant_id],
        ])->first();

        if ($request->action == 'add') {

            if ($isFound) {

                Cart::where([
                    ['id', '=', $isFound->id],
                ])->update([
                    'quantity' => $isFound->quantity + $request->quantity,
                ]);

            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id,
                    'quantity' => $request->quantity,
                ]);
            }

        } else {

            if ($isFound) {

                $quantity = 0;
                if ($request->quantity < $isFound->quantity) {
                    $quantity = $isFound->quantity - $request->quantity;
                } else if ($request->quantity == $isFound->quantity) {
                    $quantity = 0;
                }

                if ($quantity == 0) {
                    Cart::where([
                        ['id', '=', $isFound->id],
                    ])->delete();
                } else {
                    Cart::where([
                        ['id', '=', $isFound->id],
                    ])->update([
                        'quantity' => $quantity,
                    ]);
                }
            }
        }

        return returnApiResponse(true, ($request->action == 'add' ? 'Item added!' : 'Item Updated!'), $this->cartServices->listItems());
    }

    public function removeItem(Request $request)
    {
        $isExists = Cart::where([
            ['user_id', '=', auth()->id()],
            ['id', '=', $request->cart_id],
        ])->first();

        if ($isExists) {
            Cart::where([
                ['user_id', '=', auth()->id()],
                ['id', '=', $request->cart_id],
            ])->delete();
        }

        if (count($this->cartServices->listItems()) == 0) {
            CartCoupon::where('user_id', auth()->id())->delete();
        }

        return returnApiResponse($isExists ? true : false, $isExists ? 'Item removed!' : 'Item is not found.', $isExists ? $this->cartServices->listItems() : null);
    }

    public function cartCheckout(Request $request, CartAddress $cartAddress)
    {
        $request['id'] = !empty($request->address_id) ? $request->address_id : null;

        $validator = Validator::make($request->all(), [
            'id' => [
                'bail', 'required', 'integer',
                Rule::exists('cart_address')->where(function ($query) {
                    $query->where([['status', '=', '1'], ['user_id', '=', auth()->id()]]);
                }),
            ],
        ], [], [
            'id' => 'address id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $cartDetails = $this->cartServices->listItems();

        $data = [
            'delivery_note' => [
                'label' => 'Delivery Expected',
                'date' => '22 Jul',
            ],
            'total_amount' => $cartDetails['total_amount'],
            'coupon_details' => $cartDetails['coupon_details'],
            'address_details' => CartAddress::select($cartAddress->addressFields())->find($request->address_id),
        ];

        return returnApiResponse(true, '', $data);

    }

    public function clearCart(Request $request)
    {
        if (Cart::where('user_id', auth()->id())->count()) {
            Cart::where('user_id', auth()->id())->delete();
            CartCoupon::where('user_id', auth()->id())->delete();
        }
        return returnApiResponse(true, 'Cleared!', $this->cartServices->listItems());
    }

    public function saveAddress(Request $request)
    {
        if (in_array($request->action, ['save', 'update'])) {
            $billing = $request->address;
            $shippingAddress = [
                "address_type" => $billing['address_type'],
                "address_type_label" => $billing['address_type_label'],
                "user_id" => auth()->id(),
                "name" => $billing['name'],
                "email_address" => $billing['email'],
                "mobile" => $billing['mobile'],
                "address" => $billing['address'],
                "city" => $billing['city'],
                "state" => $billing['state'],
                "zipcode" => $billing['zipcode'],
                "country_id" => $billing['country_id'],
            ];
        }

        if ($request->action == 'delete') {
            CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $request->id]])->delete();
        } else if ($request->action == 'save') {
            CartAddress::create($shippingAddress);
        } else if ($request->action == 'update') {
            CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $request->id]])->update($shippingAddress);
        }

        return returnApiResponse(true, ($request->action == 'delete' ? 'Removed!' : 'Saved!'), $this->getAddress($request)->original['data']);
    }

    public function getAddress(Request $request)
    {
        return returnApiResponse(true, '', CartAddress::where('user_id', auth()->id())->activeOnly());
    }

    public function listMyOrders(Request $request)
    {

        $orders = Order::select(['id', 'order_no', 'total_amount', 'tax_amount', 'shipping_amount', 'coupon_code', 'coupon_amount',
            'billing_details', 'shipping_details', 'ordered_at', 'status'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get()->makeHidden(['created_at', 'updated_at']);

        $itemsData = [];

        foreach ($orders as $ok => $order) {

            try {
                $shippingDetails = unserialize($order->shipping_details);
            } catch (\Exception $e) {
                $shippingDetails = null;
            }

            $orderedAt = formatDate($order->ordered_at, 'h:i A, d M Y');

            foreach ($order->items as $orderedItem) {

                $orderItem = [
                    'id' => $order->id,
                    'order_no' => $order->order_no,
                    'total_amount' => $order->total_amount,
                    'tax_amount' => $order->tax_amount,
                    'shipping_amount' => $order->shipping_amount,
                    'coupon_code' => $order->coupon_code,
                    'coupon_amount' => $order->coupon_amount,
                    'shipping_details' => $order->shipping_details,
                    'ordered_at' => $order->ordered_at,
                    'status' => $order->status,
                ];
                $orderItem['tracking_details'] = $this->orderServices->trackingDetails($order);
                $orderItem['shipping_details'] = $shippingDetails;
                $orderItem['item'] = $orderedItem;

                try {
                    $orderItem['billing_details'] = !empty(unserialize($order->billing_details)) ? unserialize($order->billing_details) : null;
                } catch (\Throwable $th) {
                    $orderItem['billing_details'] = null;
                }

                try {
                    $productDetails = !empty(unserialize($orderedItem->product_details)) ? unserialize($orderedItem->product_details) : null;

                } catch (\Throwable $th) {
                    $productDetails = null;
                }

                if (!empty($productDetails)) {
                    $productDetails['image'] = asset('storage/' . $productDetails['image']);
                }

                $orderItem['item']['product_details'] = $productDetails;
                $orderItem['ordered_at'] = $orderedAt;

                $orderItem['delivery_note'] = 'Delivery Expected Date 22 Jul';

                unset($orderItem['item']['created_at']);
                unset($orderItem['item']['updated_at']);
                unset($orderItem['items']);
                array_push($itemsData, $orderItem);
            }
        }

        return returnApiResponse(true, '', $itemsData);
    }

    public function createOrder(Request $request, CartAddress $cartAddress)
    {
        $validator = Validator::make($request->all(), [
            'payment_mode' => 'bail|required',
            'address_id' => 'bail|required|integer',
            'payment_status' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $cartItems = Cart::where('user_id', auth()->id())->get();
        if (!count($cartItems)) {
            return returnApiResponse(false, 'Cart is empty');
        }

        if ($request->payment_mode == 'card') {
            $isOrderExists = Order::where([['user_id', '=', auth()->id()], ['is_dummy_order', '=', 1]])->first();

            Order::where('id', $isOrderExists->id)->update([
                'is_dummy_order' => 0,
                'status' => $request->payment_status ? 3 : 9,
                'payment_status' => $request->payment_status,
            ]);

            Payment::where('order_id', $isOrderExists->id, )->update([
                'status' => $request->payment_status,
                'payment_response' => serialize(!empty($request->return_response) ? $request->return_response : []),
            ]);

            if ($request->payment_status) {
                $this->cartServices->clearUserCart();
            }

            //Create status
            $this->orderServices->updateOrderStatusHistory([
                [
                    'order_id' => $isOrderExists->id,
                    'status_code' => 1,
                    'updated_by' => auth()->id(),
                ], [
                    'order_id' => $isOrderExists->id,
                    'status_code' => 3,
                    'updated_by' => 1,
                ],
            ]);

            // send mail;
            $this->appMailService->sendMail('orderMail', ['toAddress' => auth()->user()->email], Order::find($isOrderExists->id));

            return returnApiResponse(true, 'Order created!', [
                'order_id ' => $isOrderExists->id,
                'payment_status' => $request->payment_status,
                'payment_mode' => 'card',
            ]);
        }

        $cartData = $this->cartServices->listItems();

        // if ($request->payment_mode == 'card') {

        //     $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();

        //     if (!$stripeConfig) {
        //         return returnApiResponse(false, 'Stripe configuation is not available');
        //     }
        // }

        $cartAmount = $taxAmount = $totalAmount = $shippingAmount = $couponAmount = $orderNo = 0;
        list($couponCode, $billingDetails, $shippingDetails, $orderItems) = [[], [], [], []];

        $shippingDetails = CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $request->address_id]])
            ->select($cartAddress->addressFields())->first();

        if (empty($shippingDetails)) {
            return returnApiResponse(false, 'Shipping address is empty');
        }

        $shippingDetails = $shippingDetails->toArray();

        foreach ($cartItems as $key => $value) {

            $product = Product::where([
                ['status', '=', '1'],
                ['id', '=', $value->product_id],
            ])->first();

            if ($product) {

                $price = $value->variant->price;
                $productDetails = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category_id' => $product->category_id,
                    'category_name' => $product->category->name,
                    'brand_id' => $product->brand_id,
                    'brand_name' => $product->brand->name ?? '',
                    'image' => $product->cover_image,
                    'variant_name' => $value->variant->name,
                    'unit_name' => $value->variant->unit->name,
                ];

                $orderItems[] = [
                    'order_id' => 0,
                    'product_id' => $product->id,
                    'variant_id' => $value->variant_id,
                    'quantity' => $value->quantity,
                    'price' => $price,
                    'total_price' => $price * $value->quantity,
                    'product_details' => serialize($productDetails),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $cartAmount += $price * $value->quantity;
            }
        }

        $totalAmount = $cartAmount;

        if ($totalAmount > 0) {

            $orderNo = sprintf('%05d', Order::count());

            $couponAmount = $cartData['unformatted_discount_amount'];
            $shippingAmount = $cartData['unformatted_delivery_amount'];
            if (!empty($cartData['coupon_details'])) {
                $couponCode = $cartData['coupon_details']->toArray();
            }

            //Create order
            $order = Order::create([
                'order_no' => $orderNo,
                'payment_mode' => $request->payment_mode,
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'tax_amount' => $taxAmount,
                'amount' => $cartAmount,
                'shipping_amount' => $shippingAmount,
                'coupon_amount' => $couponAmount,
                'coupon_code' => serialize($couponCode),
                'billing_details' => serialize($billingDetails),
                'shipping_details' => serialize($shippingDetails),
                'ordered_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 3,
            ]);

            //Update payment
            $sent_response = [];
            $payment = Payment::create([
                'order_type' => $request->payment_mode,
                'order_id' => $order->id,
                'status' => 0,
                'sent_response' => serialize($sent_response),
            ]);
            Order::where('id', $order->id)->update(['payment_id' => $payment->id]);

            //Assign order id to items
            array_walk_recursive($orderItems, function (&$item, $key) use ($order) {
                if ($key == 'order_id') {
                    $item = $order->id;
                }
            });
            OrderItem::insert($orderItems);

            //create stripe
            // if ($request->payment_mode == 'card') {
            //     $stripeResults = $this->paymentServices->createStripePaymentIntend($order->id, $payment->id);

            //     if ($stripeResults[0] == false) {
            //         return returnApiResponse(false, $stripeResults[1], $stripeResults[2] ?? null);
            //     }

            //     //Clear cart items
            //     Cart::where('user_id', auth()->id())->delete();

            //     return returnApiResponse(true, 'Order created!', [
            //         'order_id ' => $order->id,
            //         'stripe_details' => $stripeResults[2] ?? null,
            //     ]);
            // }

            //Clear cart items
            $this->cartServices->clearUserCart();

            //Create status
            $this->orderServices->updateOrderStatusHistory([
                [
                    'order_id' => $order->id,
                    'status_code' => 1,
                    'updated_by' => auth()->id(),
                ], [
                    'order_id' => $order->id,
                    'status_code' => 3,
                    'updated_by' => 1,
                ],
            ]);

            // send mail;
            $this->appMailService->sendMail('orderMail', ['toAddress' => auth()->user()->email], Order::find($order->id));

            return returnApiResponse(true, 'Order created!', [
                'order_id ' => $order->id,
                'payment_status' => 0,
                'payment_mode' => 'pod',
            ]);
        }

        return returnApiResponse(false, 'Cart items are not available');
    }

    public function addToWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'bail|required',
            'product_id' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $conditions = [
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ];

        if ($request->action == "add") {

            if (!Product::find($request->product_id)) {
                return returnApiResponse(false, 'Product dose not exists.');
            }

            ProductWishlist::firstOrCreate($conditions);
        } else if ($request->action == "remove") {
            ProductWishlist::where($conditions)->delete();
        } else if ($request->action == "clear-all") {
            ProductWishlist::where('user_id', auth()->id())->delete();
        }

        $data = $this->ListWishlist($request)->original['data'];

        return returnApiResponse(true, ($request->action == "clear-all" ? 'Wishlist cleared' : (($request->action == "add" ? 'Added to' : 'Removed from') . ' wishlist')), $data);
    }

    public function ListWishlist(Request $request)
    {
        $data = ProductWishlist::with(['product' => function ($query) {
            $query->select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image',
                'description')->with('variants:id,product_id,name,price,unit_id');
        }])->where('user_id', auth()->id())->latest()->get()->pluck('product');

        $products = [];

        $data->map(function ($row) {
            $row->cover_image = $row->formatedcoverimageurl;
            $row->variants->map(function ($vr) {
                $vr->name .= $vr->unit->name;
                unset($vr->unit);
                return $vr;
            });

            $row->supplier_name = !empty($row->user_id) ? $row->supplier->name : null;
            $row->category_name = $row->category->name; // Category::find($row->category_id)->name;
            $row->brand_name = !empty($row->brand_id) ? $row->brand->name : '';
            unset($row->supplier);
            unset($row->category);

            return $row;
        });

        return returnApiResponse(true, '', $data);
    }

    public function applyPromocode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required|integer',
            'action' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        if ($request->action == 'remove') {
            CartCoupon::where('coupon_id', $request->coupon_id)->delete();
            return returnApiResponse(true, 'Removed!');
        }

        $isActive = Coupon::where('status', '1')->find($request->coupon_id);

        if (!$isActive) {
            return returnApiResponse(false, 'Coupon id is not available');
        }

        $isAlreadyApplied = CartCoupon::where([
            ['user_id', '=', auth()->id()],
            ['status', '=', '1'],
        ])->first();

        if ($isAlreadyApplied) {

            if ($isAlreadyApplied->coupon_id != $isActive->id) {
                $isAlreadyApplied->coupon_id = $isActive->id;
                $isAlreadyApplied->save();
            } else {
                return returnApiResponse(true, 'Already applied!');
            }

            return returnApiResponse(true, 'Applied!');

        }

        CartCoupon::create([
            'user_id' => auth()->id(),
            'coupon_id' => $isActive->id,
        ]);

        return returnApiResponse(true, 'Applied!');

    }

    public function listPromocodes(Request $request)
    {

        $columns = ['id', 'title', 'code', 'offer_value', 'coupon_type', 'image', 'start_date', 'end_date', 'description'];
        $data = Coupon::select($columns)
            ->where('nature', 'general')->activeOnly();

        $data->map(function ($row) {
            $row['image'] = $row->formatedimageurl;
            return $row;
        });

        $couponsData = [];
        $coupons = count($data) > 0 ? $data->toArray() : [];

        if ($request->has('user_id') && !empty($request->user_id)) {

            $userExists = User::find($request->user_id);

            if ($userExists) {
                $referralCoupon = Coupon::select($columns)->where([['nature', '=', 'referral'], ['user_id', '=', $request->user_id], ['status', '=', '1']])->first();

                if ($referralCoupon) {
                    $referralCoupon->image = $referralCoupon->formatedimageurl;
                    $couponsData[] = $referralCoupon->toArray();
                    // $couponsData = array_merge($couponsData,$coupons);
                }
            }

        }

        if (empty($couponsData)) {
            $couponsData = $coupons;
        }

        return returnApiResponse(true, '', $couponsData);
    }

    public function listFrequentItems(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $paginateCount = 20;
        $page = $request->has('page') ? $request->page : 1;
        $limitCount = !in_array($page, [0, 1]) ? $paginateCount * ($request->page - 1) : 0;

        $frequentItemsTotal = OrderItem::groupBy('product_id')->get()->count();

        if ($frequentItemsTotal >= $limitCount) {

        }

        $frequentItems = OrderItem::select('product_id', DB::raw('sum(quantity) as sale_count'))->groupBy('product_id')
            ->orderBy('sale_count', 'desc')
            ->offset($limitCount)
            ->limit($paginateCount)
            ->get();

        $productIds = !empty($frequentItems) ? $frequentItems->pluck(['product_id']) : [];

        $products = Product::select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1')->orderBy('price');
        }]);

        $products = $products->whereIn('id', $productIds);

        $products = $products->activeOnly();

        $products = $products->map(function ($row) {
            $row->cover_image = $row->formatedcoverimageurl;
            $row->variants->map(function ($vr) {
                $vr->name .= $vr->unit->name;
                unset($vr->unit);
                return $vr;
            });
            return $row;
        });

        $paginateData = OrderItem::select('product_id', DB::raw('sum(quantity) as sale_count'))->groupBy('product_id')
            ->orderBy('sale_count', 'desc')
            ->offset(($limitCount + $paginateCount))
            ->limit($paginateCount)
            ->get()->count();

        return returnApiResponse(true, '', [
            'is_last_page' => $paginateData ? false : true,
            'items' => $products,
        ]);
    }

    public function dynamicPages(Request $request)
    {
        $hmlData = CommonDatas::select(['id', 'value_1 as html'])->where([['key', '=', trim($request->key)], ['status', '=', '1']])->first();
        return returnApiResponse(true, '', $hmlData ? $hmlData : null);
    }

    public function paymentMethods(Request $request)
    {
        return returnApiResponse(true, '', [
            [
                'type' => 'card',
                'name' => 'Credit Card',
                'notes' => '',
            ],
            [
                'type' => 'pod',
                'name' => 'Pay On Delivery',
                'notes' => 'Pay with cash',
            ],
        ]);
    }

    public function listCountries(Request $request)
    {
        return returnApiResponse(true, '', Countries::activeOnly());
    }

    public function searchProductNames(Request $request)
    {
        return returnApiResponse(true, '', Product::select(['id', 'name'])->activeOnly());
    }

    public function searchProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_key' => ['required'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $searchKey = trim($request->search_key);
        $collectionProductIds = [];

        //search by product name
        $searchByProductNameIds = Product::whereRaw("LOWER(name) LIKE '%" . strtolower($searchKey) . "%'")->activeOnly()
            ->pluck('id')->toArray();
        if (!empty($searchByProductNameIds)) {
            $collectionProductIds = array_merge($collectionProductIds, $searchByProductNameIds);
        }

        //search by category name & id
        $searchByCategoryIds = Product::where([['category_id', '=', $searchKey], ['status', '=', '1']])
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '1');
            })->get()
            ->pluck('id')->toArray();

        if (!empty($searchByCategoryIds)) {
            $collectionProductIds = array_merge($collectionProductIds, $searchByCategoryIds);
        }

        $searchByCategoryName = Product::where('status', '1')
            ->whereHas('category', function (Builder $query) use ($searchKey) {
                $query->where('status', '1')->whereRaw("LOWER(name) LIKE '%" . strtolower($searchKey) . "%'");
            })->get()
            ->pluck('id')->toArray();

        if (!empty($searchByCategoryName)) {
            $collectionProductIds = array_merge($collectionProductIds, $searchByCategoryName);
        }

        $data = [];
        if (!empty($collectionProductIds)) {

            $data = Product::select('id', 'code', 'name', 'cover_image', 'description')
                ->with(['variants' => function ($query) {
                    $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
                }, 'images' => function ($query) {
                    $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
                }])
                ->whereIn('id', array_unique($collectionProductIds))->activeOnly();

            $data = $data->map(function ($row) {

                $row['cover_image'] = $row->formatedcoverimageurl;

                $row['images'] = $row['images']->map(function ($img) {
                    $img['file_name'] = $img->formatedimageurl;
                    unset($img['product_id']);
                    return $img;
                });

                $row['variants'] = $row['variants']->map(function ($var) {
                    $var['name'] = $var->name . $var->unit->name;
                    unset($var['product_id']);
                    unset($var['unit_id']);
                    unset($var['unit']);
                    return $var;
                });

                unset($row['supplier']);
                return $row;
            });

        }

        return returnApiResponse(true, '', $data);
    }

    public function updatecardStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'bail|required|exists:orders,id',
            'status' => 'bail|required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $order = Order::find($request->order_id);

        if ($order->payment_mode != 'card') {
            return returnApiResponse(false, 'Payment mode is not card.');
        }

        if ($order->payment_status == 1) {
            return returnApiResponse(false, 'Payment is already done.');
        }

        $order->payment_status = $request->status;
        $order->save();

        Payment::where([['order_id', '=', $order->id]])->update(['status' => $request->status]);

        return returnApiResponse(true, 'Payment status updated successfully.');
    }

    public function updatePodStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_id' => 'bail|required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $order = Order::find($request->order_id);

        if ($order->payment_mode != 'pod') {
            return returnApiResponse(false, 'Payment mode is not pod.');
        }

        if ($order->payment_status == 1) {
            return returnApiResponse(false, 'Payment is already done.');
        }

        $order->payment_status = 1;
        $order->save();

        Payment::where([['order_id', '=', $order->id]])->update(['status' => 1]);

        return returnApiResponse(true, 'Payment is received successfully.');

    }

    public function referralDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_platform' => 'sometimes',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $referralDiscountDetails = CommonDatas::where([['key', '=', 'referral-discount-amount'], ['status', '=', '1']])->first();
        $appImages = CommonDatas::where([['key', '=', 'app_images'], ['status', '=', '1']])->first();
        $appShareImage = $appImages && !empty($appImages->value_1) ? url($appImages->value_1) : url('images/noimage.png');

        $referralCode = User::find(auth()->id())->referral_code;
        $devicePlatform = empty($request->device_platform) ? 'android' : trim($request->device_platform);
        $data = [
            'referral_user_amount' => $referralDiscountDetails->value_2 ?? 0,
            'user_amount' => $referralDiscountDetails->value_3 ?? 0,
            'referral_code' => $referralCode,
            'app_image' => $appShareImage,
            'url' => route('frontend.referral-by', ['device_platform' => $devicePlatform, 'referral_code' => $referralCode]),
        ];

        return returnApiResponse(true, '', $data);
    }
}
