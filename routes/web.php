<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/dashboard', function () {
    if(Auth::user()->hasRole('owner')) {
        return redirect()->route('owner.dashboard');
    } elseif(Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif(Auth::user()->hasRole('buyer')) {
        return redirect()->route('buyer.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:owner|admin'])->group(function () {
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/laporan', [TransactionController::class, 'laporan'])->name('laporan');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/upload/{id}', [OrderController::class, 'upload'])->name('order.upload');
    Route::get('/order/{transaction}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/faktur/{id}', [OrderController::class, 'faktur'])->name('faktur');
});

Route::get('/product', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
    Route::get('/history', [BuyerController::class, 'history'])->name('buyer.order');
    Route::post('/checkout', [TransactionController::class, 'store'])->name('checkout');
    Route::get('/checkout/{transaction}', [TransactionController::class, 'show'])->name('transaction');
    Route::get('/checkout/success/{transaction}', [TransactionController::class, 'success'])->name('checkout-success');
});

Route::get('/mailcok', [TransactionController::class, 'mail']);

require __DIR__.'/auth.php';
