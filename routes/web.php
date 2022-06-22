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
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('home');
// Customers
Route::get('/customers', [customerController::class, 'index'])->middleware(['auth'])->name('customers');
Route::get('/customer/{slug}', [customerController::class, 'details'])->middleware(['auth'])->name('customer-details');
// Invoices
Route::get('/invoices', [factuurController::class, 'index'])->middleware(['auth'])->name('invoices');
Route::get('/invoice/{status}/{id}', [factuurController::class, 'pdf'])->middleware(['auth'])->name('invoice-pdf');
Route::get('/invoice/delete/', [factuurController::class, 'destroy'])->middleware(['auth'])->name('destroy-invoice');
Route::post('/invoice/finish/{id}', [factuurController::class, 'finish'])->middleware(['auth'])->name('finish-invoice');
Route::get('/invoice/create', [factuurController::class, 'create'])->middleware(['auth'])->name('create-invoice');
// Products
Route::get('/products', [productController::class, 'index'])->middleware(['auth'])->name('products');
// Contacts
Route::get('/contacts', [contactController::class, 'index'])->middleware(['auth'])->name('contacts');
// Mail
Route::get('/invoice/mailto/', [mailController::class, 'index'])->middleware(['auth'])->name('mail-invoice');

// Dashboard
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
