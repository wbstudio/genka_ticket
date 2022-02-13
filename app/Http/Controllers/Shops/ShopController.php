<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Shop\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\ShopEmailRegistMail;
use App\Mail\ShopEmailResetPasswordMail;
use Illuminate\Support\Facades\Mail;

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
        $shopData["hash_email"] = Hash::make($shopData['email']);
        $shopData["now"] = time();

        Mail::to($shopData['email'])->send(new ShopEmailResetPasswordMail($shopData));

        //送信完了ページのviewを表示
        return view('shop.showResetPasswordForm');

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
        $shopTicketData = $mdShop->getShopTicketInfoById(5,$startTime,$endTime);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'shopTicketData' => $shopTicketData,
        ];

        return view('shop.home', $dispData);

    }

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
        
        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'shopData' => $shopData,
            'inputs' => $inputs,
            // 'shopTicketData' => $shopTicketData,
        ];

        // var_dump($request);
        // exit();

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



}
