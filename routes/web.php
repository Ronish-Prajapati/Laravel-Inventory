<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\QuotationController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Admin can access the following routes
    Route::resource('product', ProductController::class);
});
Route::middleware(['auth', 'role:Admin|Supplier|Customer'])->group(function () {
    // other users can access the following routes
    Route::resource('product', ProductController::class)->except(['create', 'edit', 'destroy']);
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

    // Route to show the form for creating a new category
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');

    // Route to store a new category in the database
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

    // Route to delete a category by ID
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::post('/admin/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
    Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::patch('/quotations/{quotation}/approve', [QuotationController::class, 'approve'])->name('quotations.approve');
    Route::get('/quotations/{quotation}/edit', [QuotationController::class, 'edit'])->name('quotations.edit');

    // Route to update a quotation (after editing)
    Route::put('/quotations/{quotation}', [QuotationController::class, 'update'])->name('quotations.update');

    // Route to delete (destroy) a quotation
    Route::delete('/quotations/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
