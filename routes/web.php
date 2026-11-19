<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ShopController,AuthController,CheckoutController,AdminController};
Route::get('/',[ShopController::class,'index'])->name('shop.index');
Route::get('/produk/{product}',[ShopController::class,'show'])->name('shop.show');
Route::get('/keranjang',[ShopController::class,'cart'])->name('shop.cart');
Route::post('/keranjang/{product}',[ShopController::class,'addToCart'])->name('cart.add');
Route::patch('/keranjang/{product}',[ShopController::class,'updateCart'])->name('cart.update');
Route::delete('/keranjang/{product}',[ShopController::class,'removeCart'])->name('cart.remove');
Route::middleware('guest')->group(function(){Route::get('/login',[AuthController::class,'login'])->name('login');Route::post('/login',[AuthController::class,'authenticate'])->name('login.store');Route::get('/register',[AuthController::class,'register'])->name('register');Route::post('/register',[AuthController::class,'store'])->name('register.store');});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function(){Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');Route::get('/pesanan',[CheckoutController::class,'history'])->name('orders.index');Route::get('/pesanan/{order}',[CheckoutController::class,'show'])->name('orders.show');});
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function(){Route::get('/',[AdminController::class,'index'])->name('dashboard');Route::get('/produk',[AdminController::class,'products'])->name('products');Route::post('/produk',[AdminController::class,'saveProduct'])->name('products.store');Route::put('/produk/{product}',[AdminController::class,'updateProduct'])->name('products.update');Route::delete('/produk/{product}',[AdminController::class,'deleteProduct'])->name('products.destroy');Route::get('/pesanan',[AdminController::class,'orders'])->name('orders');Route::patch('/pesanan/{order}',[AdminController::class,'updateOrder'])->name('orders.update');});
