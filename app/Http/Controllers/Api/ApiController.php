<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Category;
use App\Models\CommonDatas;
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
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }, 'images' => function ($query) {
            $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
        }])->where('id', $productId)->activeOnly();

        $data = $data->map(function ($row) use ($userId) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
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

            $row->product->cover_image = !empty($row->product->cover_image) ? url('images/' . $row->product->cover_image) : '';
            $row->price = $row->variant->price * $row->quantity;
            $row->formatted_price = number_format($row->variant->price * $row->quantity, 2);
            $row->unit_id = $row->variant->unit_id;
            $row->unit_name = $row->variant->unit->name;

            unset($row->variant);
            return $row;
        });

        $cartTotal = number_format($cartItems->sum('price'), 2);

        return ['cartTotal' => $cartTotal, 'cartItems' => $cartItems];

    }

    public function listCartItems(Request $request)
    {
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        $deliveryAmount = 0;
        $discountAmount = 0;
        $totalAmount = ($fetchCartDetails['cartTotal'] + $deliveryAmount) - $discountAmount;

        return returnApiResponse(true, '', [
            'sub_total' => $fetchCartDetails['cartTotal'],
            'delivery_amount' => $deliveryAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
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

        return returnApiResponse(true, 'Successfully item has been added', [
            'total_amount' => $fetchCartDetails['cartTotal'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function updateItem(Request $request)
    {
        $isFound = Cart::where([
            ['user_id', '=', auth()->id()],
            ['id', '=', $request->cart_id],
        ])->first();
        $isRemoved = 0;

        if ($isFound) {

            if (!empty($request->quantity)) {
                Cart::where([
                    ['id', '=', $isFound->id],
                ])->update([
                    'variant_id' => $request->variant_id,
                    'quantity' => $request->quantity,
                ]);

            } else {
                Cart::where([
                    ['id', '=', $isFound->id],
                ])->delete();
                $isRemoved = 1;
            }
        }

        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return returnApiResponse(true, 'Successfully item has been ' . ($isRemoved == 1 ? 'removed' : 'updated'), [
            'total_amount' => $fetchCartDetails['cartTotal'],
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
        return returnApiResponse(true, 'Successfully item has been removed', [
            'total_amount' => $fetchCartDetails['cartTotal'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function clearCart(Request $request)
    {
        Cart::where('user_id', auth()->id())->delete();
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return returnApiResponse(true, 'Successfully cart has been cleared', [
            'total_amount' => $fetchCartDetails['cartTotal'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]);
    }

    public function saveAddress(Request $request)
    {
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

        if (CartAddress::where('user_id', auth()->id())->count()) {
            CartAddress::where([['user_id', '=', auth()->id()], ['address_type', '=', '1']])->update($shippingAddress);
        } else {
            CartAddress::create($shippingAddress);
        }

        return returnApiResponse(true, 'Successfully address has been saved', $this->getAddress($request)->original['data']);
    }

    public function getAddress(Request $request)
    {
        return returnApiResponse(true, '', CartAddress::where([['user_id', '=', auth()->id()], ['address_type', '=', '1']])->first());
    }

    public function listMyOrders(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return returnApiResponse(true, '', $orders);
    }

    public function createOrder(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        $cartAmount = $taxAmount = $totalAmount = $shippingAmount = $couponAmount = $orderNo = 0;
        list($couponCode, $billingDetails, $shippingDetails, $orderItems) = [[], [], [], []];
        $addressFields = ['name', 'email_address', 'mobile', 'address', 'city', 'state', 'zipcode', 'country_id'];

        $shippingDetails = CartAddress::where([['user_id', '=', auth()->id()], ['address_type', '=', '1']])
            ->select($addressFields)->first()->toArray();

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
                    'image' => !empty($product->cover_image) ? url($product->cover_image) : '',
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

            return returnApiResponse(true, 'Successfully order has been created', [
                'order_id ' => $order->id,
            ]);
        }

        return returnApiResponse(false, 'Cart items are not available');
    }

    public function addToWishlist(Request $request)
    {
        ProductWishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        $data = $this->ListWishlist($request)->original['data'];

        return returnApiResponse(true, 'Successfully product has been added to wishlist', $data);
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

    public function removeWishlist(Request $request)
    {
        if ($request->has('product_id') && !empty($request->product_id)) {
            $product = ProductWishlist::where('product_id', trim($request->product_id))->first();
            if ($product) {
                $product->delete();
                return returnApiResponse(true, 'Successfully item has been removed.');
            } else {
                return returnApiResponse(false, 'Item does not exist.');
            }

        } else {
            ProductWishlist::where('user_id', auth()->id())->delete();
        }
        return returnApiResponse(true, 'All items are removed successfully');
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

    public function dynamicPages(Request $request, $key)
    {
        $hmlData = CommonDatas::select(['id', 'value_1 as html'])->where([['key', '=', trim($key)], ['status', '=', '1']])->first();
        return returnApiResponse(true, '', $hmlData ? $hmlData : null);
    }

    public function paymentMethods(Request $request)
    {
        return returnApiResponse(true, '', [
            [
                'type' => 'credit_card',
                'name' => 'Credit Card',
                'notes' => ''
            ],
            [
                'type' => 'debit_card',
                'name' => 'Debit Card',
                'notes' => ''
            ],
            [
                'type' => 'cod',
                'name' => 'Pay On Delivery',
                'notes' => 'Pay with cash'
            ]
        ]);
    }
}
