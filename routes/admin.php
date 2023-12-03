<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\KindsController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\adminAuth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/


Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoriesController::class, 'index'])->name('index');
            Route::post('store', [CategoriesController::class, 'store'])->name('store');
            Route::get('search', [CategoriesController::class, 'search'])->name('search');
            Route::get('{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
            Route::put('{category}', [CategoriesController::class, 'update'])->name('update');
            Route::delete('{category}', [CategoriesController::class, 'destroy'])->name('destroy');
        });
        

        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('/', [BrandsController::class, 'index'])->name('index');
            Route::post('store', [BrandsController::class, 'store'])->name('store');
            Route::get('search', [BrandsController::class, 'search'])->name('search');
            Route::get('{brand}/edit', [BrandsController::class, 'edit'])->name('edit');
            Route::put('{brand}', [BrandsController::class, 'update'])->name('update');
            Route::delete('{brand}', [BrandsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('kinds')->name('kinds.')->group(function () {
            Route::get('/', [KindsController::class, 'index'])->name('index');
            Route::post('store', [KindsController::class, 'store'])->name('store');
            Route::get('search', [KindsController::class, 'search'])->name('search');
            Route::get('{kind}/edit', [KindsController::class, 'edit'])->name('edit');
            Route::put('{kind}', [KindsController::class, 'update'])->name('update');
            Route::delete('{kind}', [KindsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('index');
            Route::get('create', [ProductsController::class, 'create'])->name('create');
            Route::post('store', [ProductsController::class, 'store'])->name('store');
            Route::get('search', [ProductsController::class, 'search'])->name('search');
            Route::get('{product}/edit', [ProductsController::class, 'edit'])->name('edit');
            Route::put('{product}', [ProductsController::class, 'update'])->name('update');
            Route::delete('{product}', [ProductsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrdersController::class,'index'])->name('index');
            Route::get('/search', [OrdersController::class,'search'])->name('search');
            Route::put('/delivered', [OrdersController::class,'delivered'])->name('delivered');
        });

    });

    require __DIR__.'/adminAuth.php';
});


