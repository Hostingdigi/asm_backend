<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartAddress;
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
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
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

    public function productDetails(Request $request, $productId, $userId = null)
    {

        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1')
                ->orderBy('price');
        }, 'images' => function ($query) {
            $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
        }])->where('id', $productId)->activeOnly();

        $data = $data->map(function ($row) use ($userId) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
            $row['cover_image'] = $row->formatedcoverimageurl;
            $row['is_added_wishlist'] = !empty($userId) ? ProductWishlist::where([
                'user_id' => $userId,
                'product_id' => $row->id,
            ])->exists() : false;

            $row['images'] = $row['images']->map(function ($img) {

                $img['file_name'] = $img->formatedimageurl;

                unset($img['product_id']);
                return $img;
            });

            $row['variants'] = $row['variants']->map(function ($var) use ($userId) {
                $var['name'] = $var->name . ' ' . $var->unit->name;

                $cart_quantity = $userId ? Cart::where([['user_id', '=', $userId], ['product_id', '=', $var['product_id']], ['variant_id', '=', $var['id']]])->first() : [];
                $var['cart_quantity'] = $cart_quantity ? $cart_quantity->quantity : 0;

                unset($var['product_id']);
                unset($var['unit_id']);
                unset($var['unit']);
                return $var;
            });

            unset($row['supplier']);
            return $row;
        });

        return returnApiResponse(true, '', $data);
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
            ->orderBy('sale_count', 'desc')->get();

        $productIds = !empty($frequentItems) ? $frequentItems->pluck(['product_id']) : [];

        $products = Product::select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }]);

        if (count($productIds) > 0) {
            $products = $products->whereIn('id', $productIds);
        }

        $products = $products->activeOnly();

        $products = $products->map(function ($row) {
            $row['cover_image'] = !empty($row->cover_image) ? url('storage/' . $row->cover_image) : '';
            return $row;
        });

        return returnApiResponse(true, '', $products);

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

        $category = Category::select(['id', 'name', 'long_name', 'image', 'banner_image'])->find($request->category_id);
        $data = [];
        $userId = $request->user_id;

        if ($category) {

            $category->long_name = empty($category->long_name) ? $category->name : $category->long_name;
            $category->image = $category->formatedimageurl;
            $category->banner_image = $category->formatedbannerimageurl;

            $data = Product::select('id', 'code', 'name', 'cover_image',
                'description')->with(['variants' => function ($query) {
                $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
            }, 'images' => function ($query) {
                $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
            }])
                ->where('category_id', $request->category_id)
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

                $row['cart_details'] = !empty($userId) ? Cart::select(['id as cart_id', 'variant_id', 'quantity'])->where([['user_id', '=', $userId], ['product_id', '=', $row->id]])->first() : null;

                unset($row['supplier']);
                return $row;
            });

        }

        return returnApiResponse(true, '', [
            'category' => $category,
            'products' => $data,
        ]);
    }

    public function fetchCartItems($userId)
    {
        $cartTotal = 0;
        $cartItems = Cart::select(['id as cart_id', 'product_id', 'variant_id', 'quantity'])->where('user_id', $userId)
            ->with(['product' => function ($query) {
                $query->select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
                    $query->select(['id', 'product_id', 'name', 'unit_id', 'price'])->with(['unit:id,name']);
                }]);
            }])->latest()->get();

        $cartItems->map(function ($row) {

            $row->product->cover_image = !empty($row->product->cover_image) ? url('storage/' . $row->product->cover_image) : '';
            $row->price = $row->variant->price * $row->quantity;
            $row->formatted_price = number_format($row->variant->price * $row->quantity, 2);
            $row->unit_id = $row->variant->unit_id;
            $row->unit_name = $row->variant->name . $row->variant->unit->name;

            unset($row->variant);
            return $row;
        });

        $cartTotal = $cartItems->sum('price');
        $deliveryAmount = 0;
        $discountAmount = 0;
        $totalAmount = number_format((($cartTotal + $deliveryAmount) - $discountAmount), 2);

        return ['cartTotal' => number_format($cartTotal, 2),
            'deliveryAmount' => $deliveryAmount,
            'discountAmount' => $discountAmount,
            'totalAmount' => $totalAmount,
            'cartItems' => $cartItems,
        ];

    }

    public function listCartItems(Request $request)
    {
        $fetchCartDetails = $this->fetchCartItems(auth()->id());

        return returnApiResponse(true, '', [
            'sub_total' => $fetchCartDetails['cartTotal'],
            'delivery_amount' => $fetchCartDetails['deliveryAmount'],
            'discount_amount' => $fetchCartDetails['discountAmount'],
            'total_amount' => $fetchCartDetails['totalAmount'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);

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

        $fetchCartDetails = $this->fetchCartItems(auth()->id());

        return returnApiResponse(true, ($request->action == 'add' ? 'Item added!' : 'Item Updated!'), [
            'sub_total' => $fetchCartDetails['cartTotal'],
            'delivery_amount' => $fetchCartDetails['deliveryAmount'],
            'discount_amount' => $fetchCartDetails['discountAmount'],
            'total_amount' => $fetchCartDetails['totalAmount'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function removeItem(Request $request)
    {
        Cart::where([
            ['user_id', '=', auth()->id()],
            ['id', '=', $request->cart_id],
        ])->delete();
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return returnApiResponse(true, 'Item removed!', [
            'sub_total' => $fetchCartDetails['cartTotal'],
            'delivery_amount' => $fetchCartDetails['deliveryAmount'],
            'discount_amount' => $fetchCartDetails['discountAmount'],
            'total_amount' => $fetchCartDetails['totalAmount'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function clearCart(Request $request)
    {
        Cart::where('user_id', auth()->id())->delete();
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return returnApiResponse(true, 'Cart cleared!', [
            'sub_total' => $fetchCartDetails['cartTotal'],
            'delivery_amount' => $fetchCartDetails['deliveryAmount'],
            'discount_amount' => $fetchCartDetails['discountAmount'],
            'total_amount' => $fetchCartDetails['totalAmount'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function saveAddress(Request $request)
    {
        if (in_array($request->action, ['save', 'update'])) {
            $billing = $request->address;
            $shippingAddress = [
                "user_id" => auth()->id(),
                "name" => $billing['name'],
                "email_address" => $billing['email'],
                "mobile" => $billing['mobile'],
                "address_type" => '1',
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
        // ->with('payment')
            ->latest()
            ->get()->makeHidden(['created_at', 'updated_at']);

        $itemsData = [];

        foreach ($orders as $ok => $order) {
            foreach ($order->items as $item) {

                $orderItem = $order;
                $orderItem->tracking_details = null;

                $orderItem['item'] = $item;

                try {
                    $orderItem['billing_details'] = !empty(unserialize($order->billing_details)) ? unserialize($order->billing_details) : null;
                } catch (\Throwable $th) {
                    $orderItem['billing_details'] = null;
                }

                try {
                    $orderItem['shipping_details'] = !empty(unserialize($order->shipping_details)) ? unserialize($order->shipping_details) : null;
                } catch (\Throwable $th) {
                    $orderItem['shipping_details'] = null;
                }

                try {
                    $productDetails = !empty(unserialize($item->product_details)) ? unserialize($item->product_details) : null;

                } catch (\Throwable $th) {
                    $productDetails = null;
                }

                if (!empty($productDetails)) {
                    $productDetails['image'] = !empty($productDetails['image']) ? asset('storage/' . $productDetails['image']) : null;
                }

                $orderItem['item']['product_details'] = $productDetails;

                $orderItem['delivery_note'] = 'Delivery Expected Date 22 Jul';

                unset($orderItem['item']['created_at']);
                unset($orderItem['item']['updated_at']);
                unset($orderItem['items']);
                array_push($itemsData, $orderItem);
            }
        }

        return returnApiResponse(true, '', $itemsData);
    }

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_mode' => 'bail|required',
            'address_id' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $cartItems = Cart::where('user_id', auth()->id())->get();

        if (empty($cartItems)) {
            return returnApiResponse(false, 'Cart is empty');
        }

        $cartAmount = $taxAmount = $totalAmount = $shippingAmount = $couponAmount = $orderNo = 0;
        list($couponCode, $billingDetails, $shippingDetails, $orderItems) = [[], [], [], []];
        $addressFields = ['name', 'email_address', 'mobile', 'address', 'city', 'state', 'zipcode', 'country_id'];

        $shippingDetails = CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $request->address_id]])
            ->select($addressFields)->first();

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

            //Create order
            $orderData = [
                'order_no' => $orderNo,
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
            ];
            $order = Order::create($orderData);

            //Update payment
            $payment = Payment::create([
                'order_type' => 'cod',
                'order_id' => $order->id,
                'status' => (string) rand(0, 1),
                'payment_response' => serialize([])
            ]);
            Order::where('id', $order->id)->update(['payment_id' => $payment->id]);

            //Assign order id to items
            array_walk_recursive($orderItems, function (&$item, $key) use ($order) {
                if ($key == 'order_id') {
                    $item = $order->id;
                }
            });
            OrderItem::insert($orderItems);

            //Clear cart items
            Cart::where('user_id', auth()->id())->delete();

            return returnApiResponse(true, 'Order created!', [
                'order_id ' => $order->id,
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
        }])->latest()->get();

        $products = [];

        foreach ($data as $key => $row) {

            $product = $row->product;
            $product->supplier_name = $product->supplier->name;
            $product->category_name = Category::find($product->category_id)->name;
            $product->brand_name = !empty($product->brand_id) ? Brand::find($product->brand_id)->name : '';

            $product->cover_image = !empty($product->cover_image) ? url('storage/' . $product->cover_image) : '';
            array_push($products, $row->product);
            unset($product->supplier);

        }

        return returnApiResponse(true, '', $products);
    }

    public function listPromocodes(Request $request)
    {
        $data = Coupon::select(['id', 'title', 'code', 'offer_value', 'coupon_type', 'image', 'start_date', 'end_date', 'description'])->activeOnly();
        $data->map(function ($row) {
            $row['image'] = $row->formatedimageurl;
            return $row;
        });

        return returnApiResponse(true, '', $data);
    }

    public function listFrequentItems(Request $request)
    {
        $frequentItems = OrderItem::select('product_id', DB::raw('sum(quantity) as sale_count'))->groupBy('product_id')
            ->orderBy('sale_count', 'desc')->get();

        $productIds = !empty($frequentItems) ? $frequentItems->pluck(['product_id']) : [];

        $products = Product::select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }]);

        if (count($productIds) > 0) {
            $products = $products->whereIn('id', $productIds);
        }

        $products = $products->activeOnly();

        $products = $products->map(function ($row) {
            $row['cover_image'] = !empty($row->cover_image) ? url('storage/' . $row->cover_image) : '';
            return $row;
        });

        return returnApiResponse(true, '', $products);
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
                'type' => 'credit_card',
                'name' => 'Credit Card',
                'notes' => '',
            ],
            [
                'type' => 'debit_card',
                'name' => 'Debit Card',
                'notes' => '',
            ],
            [
                'type' => 'cod',
                'name' => 'Pay On Delivery',
                'notes' => 'Pay with cash',
            ],
        ]);
    }

    public function listCountries(Request $request)
    {
        return returnApiResponse(true, '', Countries::activeOnly());
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
        $searchByProductNameIds = Product::whereRaw("LOWER(name) LIKE '%".strtolower($searchKey)."%'")->activeOnly()
            ->pluck('id')->toArray();
        if(!empty($searchByProductNameIds)){
            $collectionProductIds = array_merge($collectionProductIds, $searchByProductNameIds);
        }

        //search by category name & id
        $searchByCategoryIds = Product::where([['category_id','=',$searchKey],['status','=','1']])
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '1');
            })->get()
            ->pluck('id')->toArray();

        if(!empty($searchByCategoryIds)){
            $collectionProductIds = array_merge($collectionProductIds, $searchByCategoryIds);
        }

        $searchByCategoryName = Product::where('status','1')
            ->whereHas('category', function (Builder $query) use($searchKey){
                $query->where('status', '1')->whereRaw("LOWER(name) LIKE '%".strtolower($searchKey)."%'");
            })->get()
            ->pluck('id')->toArray();

        if(!empty($searchByCategoryName)){
            $collectionProductIds = array_merge($collectionProductIds, $searchByCategoryName);
        }

        $data = [];
        if(!empty($collectionProductIds)){
            $data = Product::whereIn('id',array_unique($collectionProductIds))->get();
        }
        
        return returnApiResponse(true, '', $data);
    }
}
