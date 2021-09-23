<?php

# Vendor classes
use Illuminate\Support\Facades\Route;
use Jdenticon\Identicon;

# App-generated classes
use App\Http\Controllers\OnlineShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPictureController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [OnlineShopController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::view('/', 'dashboard.index')->name('index');

    Route::resource('store', StoreController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product_picture', ProductPictureController::class);
});

Route::get('icon', function() {
    $value = $_GET['value'];
    $size = min(max(intval($_GET['size']), 20), 500);

    $icon = new Identicon();
    $icon->setValue($value);
    $icon->setSize($size);
    $icon->displayImage('png');
})->name('icon');

require __DIR__.'/auth.php';