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
Route::get('customer/register', [\App\Http\Controllers\EntranceController::class, 'create'])->name('customer.register');
Route::get('customer/linelink', [\App\Http\Controllers\EntranceController::class, 'lineLink'])->name('customer.linelink');

// ログアウト
// Route::get('multi_login/logout', [\App\Http\Controllers\customer\MultiAuthController::class, 'logout']);

// ログイン後のページ
Route::prefix('customer')->middleware('auth:customers')->group(function(){

    //Menu--BottomNavigationBar
    //HOME画面
    Route::get('home', [\App\Http\Controllers\customer\HomeController::class, 'index'])->name('customer.home');
    //Map画面 ※GoogleMapAPI
    Route::get('map', [\App\Http\Controllers\customer\MapController::class, 'index'])->name('customer.map');
    //Search画面
    Route::get('search', [\App\Http\Controllers\customer\SearchController::class, 'index'])->name('customer.search');
    //Ticket画面 ※QRcode
    Route::get('ticket', [\App\Http\Controllers\customer\TicketController::class, 'index'])->name('customer.ticket');
    //Bill画面 ※Stripe
    Route::get('bill', [\App\Http\Controllers\customer\BillController::class, 'index'])->name('customer.bill');

    //Menu--hamburger
    //履歴画面
    Route::get('history', [\App\Http\Controllers\customer\HistoryController::class, 'index'])->name('customer.history');
    //プロフィール画面
    Route::get('profile', [\App\Http\Controllers\customer\ProfileController::class, 'index'])->name('customer.profile');
    //問い合わせ画面
    Route::get('contact', [\App\Http\Controllers\customer\ContactController::class, 'index'])->name('customer.contact');
    //規約画面
    Route::get('rule', [\App\Http\Controllers\customer\RuleController::class, 'index'])->name('customer.rule');
    //使い方画面
    Route::get('explanation', [\App\Http\Controllers\customer\ExplanationController::class, 'index'])->name('customer.explanation');

    // Stripe処理
    Route::get('/subscription/success/{id}', [\App\Http\Controllers\customer\SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [\App\Http\Controllers\customer\SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::resource('subscription', \App\Http\Controllers\customer\SubscriptionController::class, ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/ticket/success/{id}', [\App\Http\Controllers\customer\TicketController::class, 'success'])->name('ticket.success');
    Route::get('/ticket/cancel', [\App\Http\Controllers\customer\TicketController::class, 'cancel'])->name('ticket.cancel');
    Route::resource('ticket', \App\Http\Controllers\customer\TicketController::class, ['only' => ['create', 'success', 'cancel', 'index']]);

});

Route::prefix('shops')->middleware('auth:shops')->group(function(){

 Route::get('dashboard', function(){ return 'ミュージシャンでログイン完了'; });

});

Route::prefix('admins')->middleware('auth:admins')->group(function(){

 Route::get('dashboard', function(){ return 'アスリートでログイン完了'; });

});

// Stripe Webhook
Route::post('stripe/webhook', [\App\Http\Controllers\WebhookController::class, 'handleWebhook']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
