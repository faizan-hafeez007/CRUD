<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

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

// frontend routes
Route::get('/', [FrontEndController::class, 'index'])->name('products');
Route::get('/filter/{id}', [FrontEndController::class, 'filters'])->name('products.filter');
Route::get('/search', [FrontEndController::class, 'search'])->name('products.search');
Route::get('cart', [FrontEndController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [FrontEndController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart/checkout', [DetailController::class, 'index'])->name('checkout.page');
Route::patch('update-cart', [FrontEndController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [FrontEndController::class, 'remove'])->name('remove.from.cart');

Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


// Admin  Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('admin');
    //PRODUCT CONTROLLER
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete']);
        Route::get('/edit/{id}', [ProductController::class, 'edit']);
        Route::put('/update/{id}', [ProductController::class, 'update']);
    });
    //CATEGORY CONTROLLER
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('/update/{id}', [CategoryController::class, 'update']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
