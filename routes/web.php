<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard')->middleware('admin.email');;
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/{cartItemId}', [CartController::class, 'update'])->name('cart.update');

Route::get('/payment', [CheckoutController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [CheckoutController::class, 'handlePayment'])->name('payment.process');

Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/payment', [StripeController::class, 'checkout'])->name('payment.process');
Route::get('/success', [StripeController::class, 'success'])->name('success');





require __DIR__.'/auth.php';
