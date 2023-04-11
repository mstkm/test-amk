<?php

use App\Http\Controllers\Authentication\ForgotPasswordController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Login / Logout
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login-action');
Route::get('/logout', function() {
  return view('not-found');
});
Route::post('/logout', [LoginController::class, 'logout']);

// Registration
Route::get('/registration', [RegistrationController::class, 'index'])->name('registration')->middleware('guest');
Route::post('/registration', [RegistrationController::class, 'register'])->name('registration-action');

// Forgot / Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'requestLink'])->name('request-link');
Route::get('/reset-password/{token}', function (string $token) {
  return view('authentication.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::get('/reset-password', function() {
  return view('not-found');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Customer
Route::post('/customer/search', [CustomerController::class, 'search'])->name('search-customer')->middleware('auth');
Route::resource('/customer', CustomerController::class)->middleware('auth');

// Item
Route::post('/item/search', [ItemController::class, 'search'])->name('search-item')->middleware('auth');
Route::resource('/item', ItemController::class)->middleware('auth');

// Transaction
Route::post('/transaction/search', [TransactionController::class, 'search'])->name('search-order')->middleware('auth');
Route::post('/transaction/order', [TransactionController::class, 'storeItems'])->name('store-items')->middleware('auth');
Route::put('/transaction/{id}/edit-order', [TransactionController::class, 'editOrder'])->name('edit-order')->middleware('auth');
Route::get('/transaction/{id}/show-edit-orderItem', [TransactionController::class, 'showEditOrderItem'])->name('show-edit-order-item')->middleware('auth')->middleware('admin');
Route::put('/transaction/{id}/edit-orderItem', [TransactionController::class, 'editOrderItem'])->name('edit-order-item')->middleware('auth');
Route::delete('/transaction/{id}/delete-orderItem', [TransactionController::class, 'deleteOrderItem'])->name('delete-order-item')->middleware('auth');
Route::get('/transaction/{id}/order', [TransactionController::class, 'addItems'])->name('add-items')->middleware('auth');
Route::get('/transaction/selectCustomer', [TransactionController::class, 'selectCustomer'])->middleware('auth');
Route::get('/transaction/selectItem', [TransactionController::class, 'selectItem'])->middleware('auth');
Route::get('/transaction/selectOrderItem', [TransactionController::class, 'selectOrderItem'])->middleware('auth');
Route::resource('/transaction', TransactionController::class)->middleware('auth');

// Staff
Route::resource('/staff', StaffController::class)->middleware('auth')->middleware('admin');
