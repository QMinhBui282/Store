<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurcharController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExportProductController;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('users', UserController::class);
    Route::resource('categorys', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('purchars', PurcharController::class);
    Route::get('/export', [ExportProductController::class, 'export'])->name('export.export');
    Route::get('/print', [PrintController::class, 'print'])->name('print.print');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
    Route::get('/cargo', [CargoController::class, 'index'])->name('cargo.index');
    Route::post('/cargo', [CargoController::class, 'store'])->name('cargo.store');
    Route::post('/cargo/change-qty', [CargoController::class, 'changeQty']);
    Route::delete('/cargo/delete', [CargoController::class, 'delete']);
    Route::delete('/cargo/empty', [CargoController::class, 'empty']);
    Route::get('/view-more/{section}', 'ChartController@showChart')->name('view_more_chart');

});
