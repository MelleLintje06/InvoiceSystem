<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\factuurController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\productController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Login page
// GET
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('home');

// Customers
// GET
Route::get('/customers', [customerController::class, 'index'])->middleware(['auth'])->name('customers');
Route::get('/customer/{slug}', [customerController::class, 'details'])->middleware(['auth'])->name('customer-details');
Route::get('/customer/create', [customerController::class, 'create'])->middleware(['auth'])->name('create-customer');
Route::get('/customer/edit', [customerController::class, 'edit'])->middleware(['auth'])->name('edit-customer');
Route::get('/customer/remove', [customerController::class, 'destroy'])->middleware(['auth'])->name('destroy-customer');

// Invoices
// GET
Route::get('/invoices', [factuurController::class, 'index'])->middleware(['auth'])->name('invoices');
Route::get('/invoice/{status}/{id}', [factuurController::class, 'pdf'])->middleware(['auth'])->name('invoice-pdf');
Route::get('/invoice/create', [factuurController::class, 'create'])->middleware(['auth'])->name('create-invoice');
Route::get('/invoice/edit', [factuurController::class, 'edit'])->middleware(['auth'])->name('edit-invoice');
Route::get('/invoice/remove', [factuurController::class, 'destroy'])->middleware(['auth'])->name('destroy-invoice');
// POST
Route::post('/invoice/post', [factuurController::class, 'post'])->middleware(['auth'])->name('post-invoice');
Route::post('/invoice/customer/post', [customerController::class, 'post'])->middleware(['auth'])->name('post-invoice-customer');
Route::post('/invoice/finish/{id}', [factuurController::class, 'finish'])->middleware(['auth'])->name('finish-invoice');

// Products
// GET
Route::get('/products', [productController::class, 'index'])->middleware(['auth'])->name('products');
Route::get('/product/create', [productController::class, 'create'])->middleware(['auth'])->name('create-product');
Route::get('/product/edit', [productController::class, 'edit'])->middleware(['auth'])->name('edit-product');
Route::get('/product/remove', [productController::class, 'destroy'])->middleware(['auth'])->name('destroy-product');
// POST
Route::post('/product/create', [productController::class, 'post'])->middleware(['auth'])->name('post-product');
Route::post('/product/edit', [productController::class, 'update'])->middleware(['auth'])->name('update-product');

// Contacts
// GET
Route::get('/contacts', [contactController::class, 'index'])->middleware(['auth'])->name('contacts');
Route::get('/contact/create', [contactController::class, 'create'])->middleware(['auth'])->name('create-contact');
Route::get('/contact/edit', [contactController::class, 'edit'])->middleware(['auth'])->name('edit-contact');
Route::get('/contact/remove', [contactController::class, 'destroy'])->middleware(['auth'])->name('destroy-contact');

// Mail
// GET
Route::get('/invoice/mailto/', [mailController::class, 'index'])->middleware(['auth'])->name('mail-invoice');

// Dashboard
// GET
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/settings', [dashboardController::class, 'settings'])->middleware(['auth'])->name('settings');

require __DIR__.'/auth.php';
