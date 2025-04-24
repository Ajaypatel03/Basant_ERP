<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerEntriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorEntriesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Routes accessible only to guests (not authenticated users)
Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Protected routes here
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('customer', CustomerController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('customerEntries', CustomerEntriesController::class);
    Route::resource('vendorEntries', VendorEntriesController::class);
    
    Route::any('/customerReport', [CustomerEntriesController::class, 'customerReportIndex'])->name('customerReport.index');
    Route::post('/customerReport', [CustomerEntriesController::class, 'customerReportIndex'])->name('customerReport.index');
Route::get('generatePDF', [CustomerEntriesController::class, 'generatePDF']);

    Route::any('/vendorReport', [VendorEntriesController::class,'vendorReportIndex'])->name('vendorReport.index');
    Route::post('/vendorReport', [VendorEntriesController::class,'vendorReportIndex'])->name('vendorReport.index');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::redirect('/', '/dashboard')->name('home')->middleware('auth');