<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomItemsController;
use App\Models\outcomingItems;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\mainDataController;
use App\Http\Controllers\incomingItemController;
use App\Http\Controllers\outcomingItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnController;
use App\Http\Middleware\isAdmin; 


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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::prefix('/')->middleware('auth',isAdmin::class)->group(function(){    
// Staff
Route::resource('staff', StaffController::class);
Route::get('/staff-export', [StaffController::class, 'export'])->name('staff.export');  
Route::get('/staff-exportPDF', [StaffController::class, 'exportPDF'])->name('staff.exportPDF');  

// Category    
Route::resource('category', categoryController::class);
Route::get('/category-export', [categoryController::class, 'export'])->name('category.export'); 
Route::get('/category-exportPDF', [categoryController::class, 'exportPDF'])->name('category.exportPDF'); 
});

// Main Data
Route::resource('mainData', mainDataController::class);
Route::get('/mainData-export', [mainDataController::class, 'export'])->name('mainData.export');
Route::get('/mainData-exportPDF', [mainDataController::class, 'exportPDF'])->name('mainData.exportPDF');

// Incoming Data
Route::resource('incoming-item', incomingItemController::class);
Route::get('/incoming-item-export', [incomingItemController::class, 'export'])->name('incoming.export');
Route::get('/incoming-item-exportPDF', [incomingItemController::class, 'exportPDF'])->name('incoming.exportPDF');

// Outcoming Data
Route::resource('outcoming-item',outcomingItemController::class);
Route::get('/outcoming-item-export', [outcomingItemController::class, 'export'])->name('outcoming.export');
Route::get('/outcoming-item-exportPDF', [outcomingItemController::class, 'exportPDF'])->name('outcoming.exportPDF');

// Loan
Route::resource('loan', LoanController::class);
Route::put('/loan/return/{id}', [LoanController::class, 'return'])->name('loan.return');
Route::get('/loan.export', [LoanController::class, 'export'])->name('loan.export');
Route::get('/loan.exportPDF', [LoanController::class, 'exportPDF'])->name('loan.exportPDF');

// Return
Route::resource('return',ReturnController::class);
Route::get('/return.export', [ReturnController::class, 'export'])->name('return.export');
Route::get('/return.exportPDF', [ReturnController::class, 'exportPDF'])->name('return.exportPDF');
