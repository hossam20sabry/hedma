<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\PaymentController;
use App\Http\Controllers\home\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home.index');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('/products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class,'index'])->name('index');
        Route::get('category/{id}', [ProductController::class, 'category'])->name('category');
        Route::get('brand/{id}', [ProductController::class, 'brand'])->name('brand');
        Route::get('search/', [ProductController::class, 'search'])->name('search');
        Route::get('/{product}/show', [ProductController::class, 'show'])->name('show');
        Route::post('/cash', [ProductController::class, 'cash'])->name('cash');
        
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/{cart_id}', [CartController::class, 'index'])->name('index');
        Route::post('/destroy_product', [CartController::class, 'destroy_product'])->name('destroy_product');
        Route::post('/add', [CartController::class, 'cart_add'])->name('add');
    });

    Route::prefix('stripe')->name('stripe.')->group(function(){
        Route::get('/', [PaymentController::class, 'show'])->name('show');
        Route::get('checkout', [PaymentController::class, 'checkout'])->name('checkout');
        Route::get('checkout/success', [PaymentController::class, 'checkoutSuccess'])->name('checkout.success');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
