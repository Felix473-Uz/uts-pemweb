<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;



Route::get('/', [CustomerController::class, 'index'])->name('homepage');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/homepage'); 
})->name('logout');

Auth::routes();
Route::get('/homepage', [CustomerController::class, 'index'])->name('homepage');
Route::get('/about', [CustomerController::class, 'about'])->name('about');
Route::get('/produk_customer', [CustomerController::class, 'produk_customer'])->name('produk_customer');
Route::post('/cart', [CustomerController::class, 'cart'])->name('cart');
Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
Route::get('/payment', [CustomerController::class, 'store'])->name('payment');
Route::get('/history', [CustomerController::class, 'history'])->name('history');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
