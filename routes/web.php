<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as Product;



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

Route::get('/',[ProjectController::class, 'index'])->name('home');

Route::get('/products', [ProjectController::class, 'products'])->name('products');

Route::get('/products/{category}', [ProjectController::class, 'specific_product'])->name('specific_product');

Route::get('/single_product', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/single_product/{id}',[ProjectController::class, 'single_product'])->name('single_product');

Route::get('/cart',[CartController::class, 'cart'])->name('cart');

Route::post('/add_to_cart',[CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart', function() {
    return redirect('/');
});

Route::post('/remove_from_cart',[CartController::class, 'remove_from_cart'])->name('remove_from_cart');
Route::get('/remove_from_cart', function() {
    return redirect('/');
});

Route::post('/edit_product_quantity',[CartController::class, 'edit_product_quantity'])->name('edit_product_quantity');
Route::get('/edit_product_quantity', function() {
    return redirect('/');
});

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::post('/place_order',[CartController::class, 'place_order'])->name('place_order');

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');

Route::get('/verify_payment/{transaction_id}', [PaymentController::class, 'verify_payment'])->name('verify_payment');

Route::get('/complete_payment', [PaymentController::class, 'complete_payment'])->name('complete_payment');

Route::get('/thank_you', [PaymentController::class, 'thank_you'])->name('thank_you');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/user_orders',[ProjectController::class, 'user_orders'])->name('user_orders');

Route::get('/user_order_details/{id}',[ProjectController::class, 'user_order_details'])->name('user_order_details');

Route::get('/search', [ProjectController::class, 'search'])->name('search');

Route::post('/search_result',[ProjectController::class, 'search_result'])->name('search_result');
Route::get('/search_result', function() {
    return redirect('/');
});

Route::resource('products_new', Product::class);
