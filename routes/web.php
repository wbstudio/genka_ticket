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
Route::get('/make/json/station', [\App\Http\Controllers\JsonController::class, 'station']);
// Route::get('/make/json/test', [\App\Http\Controllers\JsonController::class, 'test']);


// 会員ログイン周り
Route::get('customer', [\App\Http\Controllers\Customer\CustomerController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer', [\App\Http\Controllers\Customer\CustomerController::class, 'login']);
Route::get('customer/logout', [\App\Http\Controllers\Customer\CustomerController::class, 'logout'])->name('customer.logout');
Route::get('customer/linelink', [\App\Http\Controllers\Customer\CustomerController::class, 'lineLink'])->name('customer.linelink');


//会員登録周り
Route::get('customer/regist', [\App\Http\Controllers\EntranceController::class, 'regist'])->name('customer.regist');
Route::post('customer/regist', [\App\Http\Controllers\EntranceController::class, 'store'])->name('customer.store');
Route::get('entrance/linelink', [\App\Http\Controllers\EntranceController::class, 'lineLink'])->name('entrance.linelink');

// ログアウト
// Route::get('multi_login/logout', [\App\Http\Controllers\Customer\MultiAuthController::class, 'logout']);

// ログイン後のページ
Route::prefix('customer')->middleware('auth:customers')->group(function(){

    //Menu--BottomNavigationBar
    //HOME画面
    Route::get('home', [\App\Http\Controllers\Customer\HomeController::class, 'index'])->name('customer.home');
    //Map画面 ※GoogleMapAPI
    Route::get('map', [\App\Http\Controllers\Customer\MapController::class, 'index'])->name('customer.map');
    //Search画面
    Route::get('search', [\App\Http\Controllers\Customer\SearchController::class, 'index'])->name('customer.search');
    Route::post('search', [\App\Http\Controllers\Customer\SearchController::class, 'index'])->name('customer.search.post');
    //Ticket画面 ※QRcode
    Route::get('ticket', [\App\Http\Controllers\Customer\TicketController::class, 'index'])->name('customer.ticket');
    Route::get('ticket/thanks', [\App\Http\Controllers\Customer\TicketController::class, 'thanks']);
    Route::get('ticket/shortage', [\App\Http\Controllers\Customer\TicketController::class, 'shortage']);
    //Bill画面 ※Stripe
    Route::get('bill', [\App\Http\Controllers\Customer\BillController::class, 'index'])->name('customer.bill');

    //Menu--hamburger
    //履歴画面
    Route::get('history', [\App\Http\Controllers\Customer\HistoryController::class, 'index'])->name('customer.history');
    //プロフィール画面
    Route::get('profile', [\App\Http\Controllers\Customer\ProfileController::class, 'index'])->name('customer.profile');
    //問い合わせ画面
    Route::get('contact', [\App\Http\Controllers\Customer\ContactController::class, 'index'])->name('customer.contact');
    Route::post('contact', [\App\Http\Controllers\Customer\ContactController::class, 'confirm'])->name('customer.contact.confirm');
    Route::post('send', [\App\Http\Controllers\Customer\ContactController::class, 'send'])->name('customer.contact.send');
    //規約画面
    Route::get('rule', [\App\Http\Controllers\Customer\RuleController::class, 'index'])->name('customer.rule');
    //使い方画面
    Route::get('explanation', [\App\Http\Controllers\Customer\ExplanationController::class, 'index'])->name('customer.explanation');

    // Stripe処理
    Route::get('/subscription/success/{id}', [\App\Http\Controllers\Customer\SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [\App\Http\Controllers\Customer\SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::resource('subscription', \App\Http\Controllers\Customer\SubscriptionController::class, ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/ticket/success/{id}', [\App\Http\Controllers\Customer\TicketController::class, 'success'])->name('ticket.success');
    Route::get('/ticket/cancel', [\App\Http\Controllers\Customer\TicketController::class, 'cancel'])->name('ticket.cancel');
    Route::get('/ticket/create', [\App\Http\Controllers\Customer\TicketController::class, 'create'])->name('ticket.create');
    // Route::resource('ticket', \App\Http\Controllers\Customer\TicketController::class, ['only' => ['create', 'success', 'cancel', 'index']]);

});

//Ajax--customer
Route::get('/ajax/shop/{shop_id}', [\App\Http\Controllers\Ajax\ShopController::class, 'selectShopPushMaekerId']);
Route::get('/ajax/ticket_use_insert/shop/{shop_id}/service/{service_id}/ticket/{ticket_count}/customer/{customer_id}', [\App\Http\Controllers\Ajax\TicketController::class, 'insertUseTicketData']);

// Stripe Webhook
Route::post('stripe/webhook', [\App\Http\Controllers\WebhookController::class, 'handleWebhook']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Shop(店舗周り)
|--------------------------------------------------------------------------
*/
//店舗用LP
Route::get('shops', [\App\Http\Controllers\Shops\ShopController::class, 'index'])->name('shops.index');
Route::get('shops/registEmail', [\App\Http\Controllers\Shops\ShopController::class, 'registEmail'])->name('shops.showRegistEmailForm');
Route::post('shops/confirmRegistEmail', [\App\Http\Controllers\Shops\ShopController::class, 'confirmRegistEmail'])->name('shops.confirmRegistEmail');
Route::post('shops/completeRegistEmail', [\App\Http\Controllers\Shops\ShopController::class, 'completeRegistEmail'])->name('shops.completeRegistEmail');

Route::get('shops/resetPassword', [\App\Http\Controllers\Shops\ShopController::class, 'showResetPasswordForm'])->name('shops.showResetPasswordForm');
Route::post('shops/resetPassword', [\App\Http\Controllers\Shops\ShopController::class, 'sendResetPasswordMail'])->name('shops.sendResetPasswordMail');

Route::get('shops/passwordReset/{mail_hash}/{shop_id}/{now_time}', [\App\Http\Controllers\Shops\ShopController::class, 'showPasswordResetForm'])->name('shops.showPasswordResetForm');
Route::post('shops/passwordReset', [\App\Http\Controllers\Shops\ShopController::class, 'passwordReset'])->name('shops.passwordReset');


//店舗管理画面Login周り
Route::get('shops/admin', [\App\Http\Controllers\Shops\ShopController::class, 'showLoginForm'])->name('shops.login');
Route::post('shops/admin', [\App\Http\Controllers\Shops\ShopController::class, 'login']);

//店舗管理画面Login後ページ
Route::prefix('shops/admin')->middleware('auth:shops')->group(function(){
    //logout
    Route::get('/logout', [\App\Http\Controllers\Shops\ShopController::class, 'logout'])->name('shops.logout');

    //店舗基本情報を入れる前のroute
    Route::get('/registInfo', [\App\Http\Controllers\Shops\ShopController::class, 'showRegistInfoForm'])->name('shops.registInfo');
    Route::post('/registInfo/confirm', [\App\Http\Controllers\Shops\ShopController::class, 'confirmRegistInfoForm'])->name('shops.confirmInfo');
    Route::post('/registInfo/complete', [\App\Http\Controllers\Shops\ShopController::class, 'completeRegistInfoForm'])->name('shops.completeInfo');
    Route::get('/adminConfirm', [\App\Http\Controllers\Shops\ShopController::class, 'showAdminConfirmMessage'])->name('shops.adminConfirm');

    //店舗基本情報を入れた後のroute
    Route::get('/home', [\App\Http\Controllers\Shops\ShopController::class, 'home'])->name('shops.home');

    Route::get('/setting', [\App\Http\Controllers\Shops\ShopController::class, 'showSettingForm'])->name('shops.setting');

    Route::get('/offerMenuList', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuList'])->name('shops.offer_menu');
    Route::get('/offerMenu/regist', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuRegistForm'])->name('shops.showOfferMenuRegistForm');
    Route::post('/offerMenu/regist/confirm', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuRegistConfirm'])->name('shops.showOfferMenuRegistConfirm');
    Route::post('/offerMenu/regist/complete', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuRegistComplete'])->name('shops.showOfferMenuRegistComplete');
    Route::get('/offerMenu/edit/{service_id}', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuEditForm'])->name('shops.showOfferMenuEditForm');
    Route::post('/offerMenu/edit/confirm', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuEditConfirm'])->name('shops.showOfferMenuEditConfirm');
    Route::post('/offerMenu/edit/complete', [\App\Http\Controllers\Shops\ShopController::class, 'showOfferMenuEditComplete'])->name('shops.showOfferMenuEditComplete');
    Route::get('/deleteMenu/{service_id}/{shop_id}', [\App\Http\Controllers\Shops\ShopController::class, 'deleteMenu'])->name('shops.deleteMenu');

});

//Ajax--shop
Route::get('/ajax/shop/checkMakeNewMenu/{shop_id}', [\App\Http\Controllers\Shops\Ajax\ShopController::class, 'checkShopMenu']);

/*
|--------------------------------------------------------------------------
| admin(wb-studio管理)
|--------------------------------------------------------------------------
*/
Route::get('wb-studio/admin', [\App\Http\Controllers\Admin\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('wb-studio/admin', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.loginSend');
Route::prefix('wb-studio/admin')->middleware('auth:admins')->group(function(){
    Route::get('/home', [\App\Http\Controllers\Admin\AdminController::class, 'home'])->name('admin.home');

    //admin店舗管理回り
    Route::get('/shopList', [\App\Http\Controllers\Admin\AdminController::class, 'shopList'])->name('admin.shopList');
    Route::get('/shop/{shop_id}', [\App\Http\Controllers\Admin\AdminController::class, 'showShopForm'])->name('admin.showShopForm');
    Route::post('/shop/shopInfoConfirm', [\App\Http\Controllers\Admin\AdminController::class, 'shopInfoConfirm'])->name('admin.shopInfoConfirm');
    Route::post('/shop/shopInfoComplete', [\App\Http\Controllers\Admin\AdminController::class, 'shopInfoComplete'])->name('admin.shopInfoComplete');    
    Route::get('/shop/edit/{shop_id}', [\App\Http\Controllers\Admin\AdminController::class, 'showEditShopForm'])->name('admin.showEditShopForm');
    Route::post('/shop/edit/shopInfoConfirm', [\App\Http\Controllers\Admin\AdminController::class, 'shopEditInfoConfirm'])->name('admin.shopEditInfoConfirm');
    Route::post('/shop/edit/shopInfoComplete', [\App\Http\Controllers\Admin\AdminController::class, 'shopEditInfoComplete'])->name('admin.shopEditInfoComplete');
    
    //adminユーザー管理回り
    Route::get('/customerList', [\App\Http\Controllers\Admin\AdminController::class, 'customerList'])->name('admin.customerList');
    
    //admin支払い管理回り
    Route::get('/billList', [\App\Http\Controllers\Admin\AdminController::class, 'billList'])->name('admin.billList');
    
    //adminチケット管理回り
    Route::get('/ticketList', [\App\Http\Controllers\Admin\AdminController::class, 'ticketList'])->name('admin.ticketList');
    
    //admin問い合わせ管理回り
    Route::get('/contactList', [\App\Http\Controllers\Admin\AdminController::class, 'contactList'])->name('admin.contactList');
});

