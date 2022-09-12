<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductWishlist;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function listCategories(Request $request)
    {
        $data = Category::select('id', 'name', 'image', 'banner_image')->where('parent_id', 0)->activeOnly();
        $data->map(function ($row) {
            $row['image'] = !empty($row->image) ? url('storage/' . $row->image) : '';
            $row['banner_image'] = !empty($row->banner_image) ? url('storage/' . $row->banner_image) : '';
            $subCategories = Category::select('id', 'name', 'image')->where('parent_id', $row->id)->activeOnly();

            $subCategories->map(function ($sRow) {
                $sRow['image'] = !empty($sRow->image) ? url('storage/' . $sRow->image) : '';
            });

            $row['subCategories'] = $subCategories;
            return $row;
        });

        return response()->json(['status' => true, 'message' => '', 'data' => $data]);
    }

    public function listBrands(Request $request)
    {
        return response()->json(['status' => true, 'message' => '', 'data' => Brand::select(['id', 'name'])->activeOnly()]);
    }

    public function productDetails(Request $request, $productId)
    {
        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }, 'images' => function ($query) {
            $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
        }])->where('id', $productId)->activeOnly();

        $data = $data->map(function ($row) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
            $row['cover_image'] = !empty($row->cover_image) ? url('img/' . $row->cover_image) : '';

            $row['images'] = $row['images']->map(function ($img) {

                $img['file_name'] = !empty($img->file_name) ? url('storage/' . $img->file_name) : '';
                unset($img['product_id']);
                return $img;
            });

            unset($row['supplier']);
            return $row;
        });

        return response()->json(['status' => true, 'message' => '', 'data' => $data]);
    }

    public function listProducts(Request $request)
    {
        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }, 'images' => function ($query) {
            $query->select(['id', 'product_id', 'file_name'])->orderBy('display_order', 'asc');
        }])
            ->where('category_id', $request->category_id)
            ->activeOnly();

        $data = $data->map(function ($row) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
            $row['cover_image'] = !empty($row->cover_image) ? url('storage/' . $row->cover_image) : '';

            $row['images'] = $row['images']->map(function ($img) {

                $img['file_name'] = !empty($img->file_name) ? url('storage/' . $img->file_name) : '';
                unset($img['product_id']);
                return $img;
            });

            unset($row['supplier']);
            return $row;
        });

        return response()->json(['status' => true, 'message' => '', 'data' => $data]);
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
        return response()->json(['status' => true, 'message' => '', 'data' => [
            'total_amount' => $fetchCartDetails['cartTotal'],
            'cart_items' => $fetchCartDetails['cartItems'],
        ]]);
    }

    public function addItem(Request $request)
    {

        $isFound = Cart::where([
            ['user_id', '=', auth()->id()],
            ['product_id', '=', $request->product_id],
            ['variant_id', '=', $request->variant_id],
        ])->first();

        if ($isFound) {
            Cart::where([
                ['id', '=', $isFound->id],
            ])->update([
                'quantity' => $request->quantity + $isFound->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
            ]);
        }

        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return response()->json([
            'status' => true,
            'message' => 'Successfully item has been added',
            'data' => [
                'total_amount' => $fetchCartDetails['cartTotal'],
                'cart_items' => $fetchCartDetails['cartItems'],
            ]]);
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
        return response()->json([
            'status' => true,
            'message' => 'Successfully item has been ' . ($isRemoved == 1 ? 'removed' : 'updated'),
            'data' => [
                'total_amount' => $fetchCartDetails['cartTotal'],
                'cart_items' => $fetchCartDetails['cartItems'],
            ]]);
    }

    public function removeItem(Request $request)
    {
        Cart::where([
            ['user_id', '=', auth()->id()],
            ['id', '=', $request->cart_id],
        ])->delete();
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return response()->json([
            'status' => true,
            'message' => 'Successfully item has been removed',
            'data' => [
                'total_amount' => $fetchCartDetails['cartTotal'],
                'cart_items' => $fetchCartDetails['cartItems'],
            ]]);
    }

    public function clearCart(Request $request)
    {
        Cart::where('user_id', auth()->id())->delete();
        $fetchCartDetails = $this->fetchCartItems(auth()->id());
        return response()->json([
            'status' => true,
            'message' => 'Successfully cart has been cleared',
            'data' => [
                'total_amount' => $fetchCartDetails['cartTotal'],
                'cart_items' => $fetchCartDetails['cartItems'],
            ]]);
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

        return response()->json(['status' => true, 'message' => 'Successfully address has been saved',
            'data' => $this->getAddress($request)->original['data']]);
    }

    public function getAddress(Request $request)
    {
        return response()->json(['status' => true, 'message' => '', 'data' => CartAddress::where([['user_id', '=', auth()->id()], ['address_type', '=', '1']])->first(),
        ]);

    }

    public function listMyOrders(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return response()->json(['status' => true, 'message' => '', 'data' => $orders]);

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

            return response()->json([
                'status' => true,
                'message' => 'Successfully order has been created',
                'data' => [
                    'order_id ' => $order->id,
                ],
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Cart items are not available',
            'data' => null,
        ]);
    }

    public function addToWishlist(Request $request)
    {
        ProductWishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        $data = $this->ListWishlist($request)->original['data'];

        return response()->json([
            'status' => true,
            'message' => 'Successfully product has been added to wishlist',
            'data' => $data,
        ]);
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

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $products,
        ]);
    }

    public function listPromocodes(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                [
                    'id' => 1,
                    'image' => 'https://images.pexels.com/photos/11591858/pexels-photo-11591858.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
                [
                    'id' => 2,
                    'image' => 'https://images.pexels.com/photos/5782239/pexels-photo-5782239.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
                [
                    'id' => 3,
                    'image' => 'https://images.pexels.com/photos/5920641/pexels-photo-5920641.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
                [
                    'id' => 4,
                    'image' => 'https://images.pexels.com/photos/5272931/pexels-photo-5272931.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
                [
                    'id' => 5,
                    'image' => 'https: //images.pexels.com/photos/5273011/pexels-photo-5273011.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
        ]);
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

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $products,
        ]);
    }
}
