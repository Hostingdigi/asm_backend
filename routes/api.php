<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Controllers\Api\ApiAuthController;
use App\Domains\Auth\Models\User;

Route::post('register', [ApiAuthController::class,'register']);
Route::post('login', [ApiAuthController::class, 'login']);

Route::get('categories', function(){

    $data = Category::select('id','name')->where('parent_id',0)->activeOnly();

    $data = $data->map(function($row){

        $row['subCategories'] = Category::select('id','name')->where('parent_id',$row->id)->activeOnly();

        return $row;
    });

    return response()->json(['data' => $data]);
});

Route::get('brands', function () {
    return response()->json(['data' => Brand::select(['id','name'])->activeOnly()]);
});


Route::post('products', function () {

    $data = Product::select('id', 'user_id as supplier_id', 'category_id', 'brand_id', 'code', 'name', 'cover_image as image', 'unit', 'price',
        'description')->activeOnly();

    $data = $data->map(function ($row) {

        $units = ["KG","PC","LTR"];

        $row['supplier_name'] = User::find($row->supplier_id)->name;
        $row['category_name'] = Category::find($row->category_id)->name;
        $row['brand_name'] = !empty($row->brand_id) ? Brand::find($row->brand_id)->name : '';
        $row['image'] = !empty($row->image) ? url('img/'.$row->image) : '';
        $row['unit'] = $units[$row->unit-1];

        return $row;
    });

    return response()->json(['data' => $data]);
});
