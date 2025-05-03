<?php

use App\Models\outcomingItems;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\mainDataController;
use App\Http\Controllers\incomingItemController;
use App\Http\Controllers\outcomingItemController;
use App\Http\Controllers\LoanController;

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
// Staff
Route::resource('staff', StaffController::class);
// Main Data
Route::resource('mainData', mainDataController::class);
Route::get('/export', [mainDataController::class, 'export'])->name('mainData.export');
// Incoming Data
Route::resource('incoming-item', incomingItemController::class);
// Category
Route::resource('category',categoryController::class);
// Outcoming Data
Route::resource('outcoming-item',outcomingItemController::class);
// Loan
Route::resource('loan', LoanController::class);
