<?php

use Illuminate\Support\Facades\Route;

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


//集客LP
Route::get('/', [\App\Http\Controllers\EntranceController::class, 'index']);

// 会員ログイン周り
Route::get('customer', [\App\Http\Controllers\customer\CustomerController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer', [\App\Http\Controllers\customer\CustomerController::class, 'login']);

//会員登録周り
Route::get('customer/register', [\App\Http\Controllers\EntranceController::class, 'showRegistForm'])->name('customer.register');

// ログアウト
// Route::get('multi_login/logout', [\App\Http\Controllers\customer\MultiAuthController::class, 'logout']);

// ログイン後のページ
Route::prefix('customer')->middleware('auth:customers')->group(function(){
    //
    Route::get('home', [\App\Http\Controllers\customer\HomeController::class, 'index'])->name('customer.home');
    //
    Route::get('map', [\App\Http\Controllers\customer\MapController::class, 'index'])->name('customer.map');
    //
    Route::get('search', [\App\Http\Controllers\customer\SearchController::class, 'index'])->name('customer.search');
    //
    Route::get('ticket', [\App\Http\Controllers\customer\TicketController::class, 'index'])->name('customer.ticket');
    //
    Route::get('bill', [\App\Http\Controllers\customer\BillController::class, 'index'])->name('customer.bill');

});

Route::prefix('shops')->middleware('auth:shops')->group(function(){

 Route::get('dashboard', function(){ return 'ミュージシャンでログイン完了'; });

});

Route::prefix('admins')->middleware('auth:admins')->group(function(){

 Route::get('dashboard', function(){ return 'アスリートでログイン完了'; });

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
