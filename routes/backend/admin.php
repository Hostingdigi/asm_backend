<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BrandController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

//Masters
Route::prefix('masters')->group(function () {

    // Route::get('categories', [CategoryController::class, 'index'])
    //     ->name('masters.categories.index')
    //     ->breadcrumbs(function (Trail $trail) {
    //         $trail->push(__('Home'), route('admin.dashboard'))
    //             ->push(__('Masters'), '')
    //             ->push(__('Categories'), '');
    //     });
    Route::resource('categories', 'Backend\CategoryController')->names([
        'index' => 'masters.categories.index',
        'store' => 'masters.categories.store',
        'edit' => 'masters.categories.edit',
        'update' => 'masters.categories.update',
    ]);
    Route::get('categories/update/status/{userId}/{statusCode}', 'Backend\CategoryController@updateStatus')->name('masters.categories.updateStatus');
    Route::post('categories/check-duplicate', 'Backend\CategoryController@checkDuplicate')->name('masters.categories.checkDuplicate');

    // Route::get('brands', [BrandController::class, 'index'])
    //     ->name('masters.brands.index')
    //     ->breadcrumbs(function (Trail $trail) {
    //         $trail->push(__('Home'), route('admin.dashboard'))
    //             ->push(__('Masters'), '')
    //             ->push(__('Brands'), '');
    //     });
    // Route::resource('brands/store', [BrandController::class, 'store'])
    //     ->name('masters.brands.store');
    Route::resource('brands', 'Backend\BrandController')->names([
        'index' => 'masters.brands.index',
        'store' => 'masters.brands.store',
        'edit' => 'masters.brands.edit',
        'update' => 'masters.brands.update',
    ]);
    Route::get('brands/update/status/{userId}/{statusCode}', 'Backend\BrandController@updateStatus')->name('masters.brands.updateStatus');
    Route::post('brands/check-duplicate', 'Backend\BrandController@checkDuplicate')->name('masters.brands.checkDuplicate');

    // Route::resource('brands', BrandController::class)->names([
        // 'store' => 'mstr.department.store',
        // 'edit' => 'mstr.department.edit',
        // 'update' => 'mstr.department.update',
    // ]);

    Route::resource('units', 'Backend\UnitController')->names([
        'index' => 'masters.units.index',
        'store' => 'masters.units.store',
        'edit' => 'masters.units.edit',
        'update' => 'masters.units.update',
    ]);
    Route::get('units/update/status/{userId}/{statusCode}', 'Backend\UnitController@updateStatus')->name('masters.units.updateStatus');
    Route::post('units/check-duplicate', 'Backend\UnitController@checkDuplicate')->name('masters.units.checkDuplicate');

});

// Route::get('products', [ProductController::class, 'index'])
//     ->name('products.index')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('admin.dashboard'))
//             ->push(__('Products'), '');
//     });

Route::prefix('settings')->group(function () {

    Route::get('delivery-date', 'Backend\DeliveryDateController@index')->name('settings.delivery-date.index');
    Route::post('delivery-date/save-week-day', 'Backend\DeliveryDateController@saveWeekDay')->name('settings.delivery-date.saveWeekDay');
    Route::post('delivery-date/remove-day', 'Backend\DeliveryDateController@removeDay')->name('settings.delivery-date.removeDay');
    Route::post('delivery-date/save-date', 'Backend\DeliveryDateController@saveDate')->name('settings.delivery-date.saveDate');

});

    Route::resource('products', 'Backend\ProductController')->names([
        'index' => 'products.index',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
    ]);
    Route::get('products/update/status/{userId}/{statusCode}', 'Backend\ProductController@updateStatus')->name('products.updateStatus');
    Route::post('products/check-duplicate', 'Backend\ProductController@checkDuplicate')->name('products.checkDuplicate');
    Route::post('products/update-variant-status', 'Backend\ProductController@updateVariantStatus')->name('products.updateVariantStatus');
