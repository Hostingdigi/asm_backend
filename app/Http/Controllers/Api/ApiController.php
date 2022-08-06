<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function productDetails(Request $request, $productId)
    {
        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image as image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }])->where('id', $productId)->activeOnly();

        $data = $data->map(function ($row) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
            $row['image'] = !empty($row->image) ? url('img/' . $row->image) : '';

            unset($row['supplier']);
            return $row;
        });

        return response()->json(['data' => $data]);
    }

    public function listProducts(Request $request)
    {
        $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image as image',
            'description')->with(['variants' => function ($query) {
            $query->select(['id', 'product_id', 'name', 'price', 'unit_id'])->where('status', '1');
        }])->activeOnly();

        $data = $data->map(function ($row) {

            $row['supplier_name'] = $row->supplier->name;
            $row['category_name'] = Category::find($row->category_id)->name;
            $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
            $row['image'] = !empty($row->image) ? url('img/' . $row->image) : '';

            unset($row['supplier']);
            return $row;
        });

        return response()->json(['data' => $data]);
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
        return response()->json(['status' => true, 'data' => [
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
            'message' => 'Successfully item has been'.($isRemoved == 1 ? 'removed' : 'updated'),
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
}
