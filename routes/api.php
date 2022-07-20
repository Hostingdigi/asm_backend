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
use App\Http\Controllers\Api\ApiAuthController;

Route::post('register', [ApiAuthController::class,'register']);
Route::post('login', [ApiAuthController::class, 'login']);

Route::get('categories', function(){
    return response()->json(['data' => Category::activeOnly()->get()]);
});