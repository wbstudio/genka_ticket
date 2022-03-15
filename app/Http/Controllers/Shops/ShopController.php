<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Shop\Shop;
use \App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\ShopEmailRegistMail;
use App\Mail\ShopEmailResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use \App\Http\Controllers\CommonController;

class ShopController extends Controller
{
    //
    public function index()
    {
        var_dump("LP");
        return view('shop.index');
    }

    public function registEmail()
    {
        return view('shop.registEmail');
    }

    public function confirmRegistEmail(Request $request)
    {

        $request->validate([
            'email'  => [
                'required',
                Rule::unique('shops', 'email')->where('delete_flag','=',0)
            ],
            'password'  => [
                'required',
                'min:8', // 最低8文字以上
                'max:16', // 最高16文字まで
                'regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]/' // 正規表現を使って、半角英数字混在
            ],
            'confirm_password' => [
                'required', // 必須
                'same:password', // user_passwordと値が同じか
            ],
        ]);
        $inputs = $request->all();
        $countPass = strlen($inputs["password"]);
        $inputs["password_display"] = str_repeat('*',$countPass);

        $dispData = [
            'inputs' => $inputs,
        ];

        return view('shop.confirmRegistEmail', $dispData);
    }


    
    public function completeRegistEmail(Request $request)
    {
        $inputs = $request->all();
        $countPass = strlen($inputs["password"]);
        $inputs["password_display"] = str_repeat('*',$countPass);
        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('shops.showRegistEmailForm')
                ->withInput($inputs);
        } else {
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            $shop = DB::table('shops');
            $data = $shop
            ->insert(
                [
                    'email' => $inputs['email'],
                    'password' => Hash::make($inputs['password']),
                    'kind' => 0,
                    'status' => 0,
                    'delete_flag' => 0,
                ]
            );
            Mail::to($inputs['email'])->send(new ShopEmailRegistMail($inputs));
            //送信完了ページのviewを表示
            return view('shop.completeRegistEmail');
        }
    }

    public function showLoginForm()
    {
        return view('shop.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $guard = "shops";

        if (\Auth::guard($guard)->attempt($credentials)) {
            $mdShop = new Shop();
            $shopData = $mdShop->getShopInfoByEmail($request->input('email'));
            $request->session()->put('shop_id', $shopData["id"]);
            return redirect('shops/admin/home');
        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    public function logout() {

        \Auth::logout();
        return redirect()->route('shops.home');

    }

    public function showResetPasswordForm() {

        \Auth::logout();
        //送信完了ページのviewを表示
        return view('shop.showResetPasswordForm');

    }

    public function sendResetPasswordMail(Request $request) {

        $request->validate([
            'email'  => [
                'required',
                'exists:shops'
            ],
        ]);
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoByEmail($request->input('email'));
        $shopData["hash_email"] = str_replace("/","",Hash::make($shopData['email']));
        $shopData["now"] = time();

        Mail::to($shopData['email'])->send(new ShopEmailResetPasswordMail($shopData));

        //送信完了ページのviewを表示
        return view('shop.completeResetPassword');

    }

    public function showPasswordResetForm($mail_hash,$shop_id,$now_time) {

        //30分以内に
        if($now_time < time() - (30 * 60)){
            return view('shop.errorMessageResetPassword');
        }

        $shopData["id"] = $shop_id;
        $dispData = [
            'shopData' => $shopData,
        ];

        //送信完了ページのviewを表示
        return view('shop.showPasswordResetForm',$dispData);
    }

    public function passwordReset(Request $request) {

        $request->validate([
            'password'  => [
                'required',
                'min:8', // 最低8文字以上
                'max:16', // 最高16文字まで
                'regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]/' // 正規表現を使って、半角英数字混在
            ],
            'confirm_password' => [
                'required', // 必須
                'same:password', // user_passwordと値が同じか
            ],
            'shop_id' => [
                'required', // 必須
            ],
        ]);


        //再送信を防ぐためにトークンを再発行
        $request->session()->regenerateToken();
        $shop = Shop::where("id",$request->input('shop_id'))->first();
        $shop->password = Hash::make($request->input('password'));
        $shop->save();

        //送信完了ページのviewを表示
        return view('shop.passwordReset');
    }

    public function home()
    {
        $page_title = "";
        $page_type = "";
        $timestamp = time();
        // $startTime = date("Y-m-01 00:00:00", $timestamp);
        // $endTime = date("Y-m-d H:i:s", $timestamp);
        //toDo--test用にチケット利用のある時間に設定
        $startTime = date("2021-10-01 00:00:00");
        $endTime = date("2021-12-31 00:00:00");

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        if(!($shopData["name"]) && $shopData["status"] == 0){
            return redirect()->route('shops.registInfo');
        }else if(isset($shopData["status"]) && $shopData["status"] == 1){
            return redirect()->route('shops.adminConfirm');
        }
        // $shopTicketData = $mdShop->getShopTicketInfoById($shopId);
        //toDo--test用にチケット利用のあるshop_idに設定
        // $shopTicketData = $mdShop->getShopTicketInfoById(5,$startTime,$endTime);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.home', $dispData);

    }

    //登録系
    public function showRegistInfoForm()
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);

        if($shopData["name"] && $shopData["status"] == 1){
            return redirect()->route('shops.adminConfirm');
        }else if(isset($shopData["status"]) && $shopData["status"] == 2){
            return redirect()->route('shops.home');
        }

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showRegistInfoForm', $dispData);

    }

    public function confirmRegistInfoForm(Request $request)
    {

        //
        $request->validate([
            'name' => 'required',
            'adress' => 'required',
            'kind'  => 'required',
            'category'  => 'required',
            'phone'  => 'required',
            'business_hour' => 'required',
        ]);

        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $inputs = $request->all();
        $inputs["kind_str"] = config('shop.kind')[$request->kind];
        $inputs["category_str"] = config('shop.category')[$request->category];
        
        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'inputs' => $inputs,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.confirmRegistInfoForm', $dispData);

    }


    public function completeRegistInfoForm(Request $request)
    {

        // $page_title = "";
        // $page_type = "";

        // $mdShop = new Shop();
        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');
        
        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('shops.registInfo')
                ->withInput($inputs);
        } else {
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            $shop = Shop::where("id",$request->input('id'))->first();
            $shop->name = $request->input('name');
            $shop->kind = $request->input('kind');
            $shop->category = $request->input('category');
            $shop->adress = $request->input('adress');
            $shop->phone = $request->input('phone');
            $shop->business_hour = $request->input('business_hour');
            $shop->xaxis = $request->input('xaxis');
            $shop->yaxis = $request->input('yaxis');
            $shop->status = 1;
            $shop->save();

            //送信完了ページのviewを表示
            return view('shop.completeRegistInfoForm');
        }
        
    }

    public function showAdminConfirmMessage()
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);

        if(!($shopData["name"]) && $shopData["status"] == 0){
            return redirect()->route('shops.registInfo');
        }else if(isset($shopData["status"]) && $shopData["status"] == 2){
            return redirect()->route('shops.home');
        }

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showAdminConfirmMessage', $dispData);

    }

    public function showEditInfoForm()
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showEditInfoForm', $dispData);

    }

    public function confirmEditInfoForm(Request $request)
    {

        //
        $request->validate([
            'business_hour' => 'required',
        ]);

        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $inputs = $request->all();
        $inputs["kind_str"] = config('shop.kind')[$request->kind];
        $inputs["category_str"] = config('shop.category')[$request->category];
        
        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'inputs' => $inputs,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.confirmEditInfoForm', $dispData);

    }


    public function completeEditInfoForm(Request $request)
    {

        // $page_title = "";
        // $page_type = "";

        // $mdShop = new Shop();
        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');
        
        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('shops.showEditInfoForm')
                ->withInput($inputs);
        } else {
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            $shop = Shop::where("id",$request->input('id'))->first();
            $shop->business_hour = $request->input('business_hour');
            $shop->save();

            //送信完了ページのviewを表示
            return view('shop.completeEditInfoForm');
        }
        
    }

    //menu系
    public function showOfferMenuList()
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $shopServiceList = $mdShop->getShopMenuInfoById($shopId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'shopServiceList' => $shopServiceList,
        ];

        return view('shop.showOfferMenuList', $dispData);

    }

    //menu系
    public function showOfferMenuRegistForm()
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showOfferMenuRegistForm', $dispData);

    }

    public function showOfferMenuRegistConfirm(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'shop_id' => 'required',
        ]);

        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $inputs = $request->all();

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'inputs' => $inputs,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showOfferMenuRegistConfirm', $dispData);

    }

    public function showOfferMenuRegistComplete(Request $request)
    {

        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');
        
        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('shops.showOfferMenuRegistForm')
                ->withInput($inputs);
        } else {
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            $service = DB::table('services');
            $data = $service
            ->insert(
                [
                    'shop_id' => $inputs['shop_id'],
                    'ticket' => $inputs['ticket'],
                    'detail' => $inputs['detail'],
                    'name' => $inputs['name'],
                    'delete_flag' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            //送信完了ページのviewを表示
            return view('shop.showOfferMenuRegistComplete');
        }
        

    }


    public function showOfferMenuEditForm($service_id)
    {
        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $mdService = new Service();
        $shopData = $mdShop->getShopInfoById($shopId);
        $serviceData = $mdService->getServiceInfoById($shopId,$service_id);

        $disable_flag = 0;
        if(strtotime($serviceData->updated_at) > time() - (22 * 60 * 60)){
            $disable_flag = 1;
        }
        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'serviceData' => $serviceData,
            'disable_flag' => $disable_flag,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showOfferMenuEditForm', $dispData);

    }

    public function showOfferMenuEditConfirm(Request $request)
    {

        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'shop_id' => 'required',
        ]);

        $page_title = "";
        $page_type = "";

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $inputs = $request->all();

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'inputs' => $inputs,
            // 'shopTicketData' => $shopTicketData,
        ];

        return view('shop.showOfferMenuEditConfirm', $dispData);

    }

    public function showOfferMenuEditComplete(Request $request)
    {

        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');
        
        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('shops.showOfferMenuEditForm',['service_id' => $request->input('service_id')])
                ->withInput($inputs);
        } else {
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            $service = Service::where("id",$request->input('service_id'))->first();
            $service->name = $request->input('name');
            $service->detail = $request->input('detail');
            $service->updated_at = now();
            $service->save();

            //送信完了ページのviewを表示
            return view('shop.showOfferMenuEditComplete');
        }
        
    }

    

    public function deleteMenu($service_id,$shop_id)
    {

        new Service();

        $whereList = [
            ["id","=",$service_id],
            ["shop_id","=",$shop_id],
        ];

        $service = Service::where($whereList)->first();
        $service->delete_flag = 1;
        $service->save();

            //送信完了ページのviewを表示
        return redirect()->route('shops.offer_menu');



    }


    public function ticketList(Request $request)
    {
        $page_title = "";
        $page_type = "";
        $timestamp = time();
        $startTime = date("Y-m-01 00:00:00", $timestamp);
        $nowMonth = date("Y-m", $timestamp);
        $month = date("Y-m", $timestamp);
        $endTime = date("Y-m-d H:i:s", $timestamp);
        $currentPage = 1;
        $perPage = 20;

        if($request->input('month')){
            $month = $request->input('month');
            $monthData["current"] = $month;
            $startTime = $month.'-01 00:00:00'; 
            $endTime = date('Y-m-d', strtotime('last day of ' . $month)).' 23:59:59';
        }
        if($request->input('page')){
            $currentPage = $request->input('page');
        }

        if($nowMonth > $month){
            $monthData["forward"] = date('Y-m', strtotime($month.' +1 month'));
        }
        $monthData["back"] = date('Y-m', strtotime($month.' -1 month'));
        $monthData["current"] = $month;
        $monthData["current_str"] = substr($month, 0, 4).'年'.substr($month, 5, 2).'月';

        $shopId = session('shop_id');
        $mdShop = new Shop();
        $shopData = $mdShop->getShopInfoById($shopId);
        $shopTicketDataForPager = $mdShop->getShopTicketInfoById($shopId,$startTime,$endTime,$currentPage - 1,$perPage);
        $commonController = new CommonController;
        $pagenator = $commonController->purepagenator($shopTicketDataForPager["count"],$currentPage,$perPage);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'shopTicketList' => $shopTicketDataForPager["dispData"],
            'pagenator' => $pagenator -> link,
            'monthData' => $monthData,
            'page' => $currentPage,
        ];


        return view('shop.showTicketList', $dispData);

    }



}
