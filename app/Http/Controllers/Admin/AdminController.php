<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use \App\Models\Admin;
use \App\Models\Shop\Shop;


class AdminController extends Controller
{
    //
        //
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $guard = "admins";
        if (\Auth::guard($guard)->attempt($credentials)) {
            return redirect('wb-studio/admin/home');
        }
        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    public function home()
    {
        return view('admin.home');
    }

    public function shopList()
    {
        $mdAdmin = new Admin();
        $adminShopList = $mdAdmin->getShopList();

        $dispData = [
            'adminShopList' => $adminShopList,
        ];

        return view('admin.shopList', $dispData);
    }

    public function showShopForm($shop_id)
    {
        $mdAdmin = new Admin();
        $adminShopData = $mdAdmin->getShopData($shop_id);

        $dispData = [
            'adminShopData' => $adminShopData,
        ];

        return view('admin.showShopForm', $dispData);
    }

    public function shopInfoConfirm(Request $request)
    {
 
        $request->validate([
            'name' => 'required',
            'adress' => 'required',
            'kind'  => 'required',
            'category'  => 'required',
            'phone'  => 'required',
            'business_hour' => 'required',
            'xaxis' => 'required',
            'yaxis' => 'required',
        ]);

        $inputs = $request->all();

        $dispData = [
            'inputs' => $inputs,
        ];

        return view('admin.shopInfoConfirm', $dispData);
    }

    public function shopInfoComplete(Request $request)
    {
        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('admin.showShopForm',['shop_id' => $inputs['id']])
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
            $shop->status = 2;
            $shop->save();

            //メールでpdf契約書？

            //送信完了ページのviewを表示
            return view('admin.shopInfoComplete');
        }

    }

    public function showEditShopForm($shop_id)
    {
        $mdAdmin = new Admin();
        $adminShopData = $mdAdmin->getShopData($shop_id);
        var_dump($adminShopData["status"]);

        $dispData = [
            'adminShopData' => $adminShopData,
        ];

        return view('admin.showEditShopForm', $dispData);
    }

    public function shopEditInfoConfirm(Request $request)
    {
 
        $request->validate([
            'name' => 'required',
            'adress' => 'required',
            'kind'  => 'required',
            'category'  => 'required',
            'phone'  => 'required',
            'business_hour' => 'required',
            'xaxis' => 'required',
            'yaxis' => 'required',
            'status' => 'required',
        ]);

        $inputs = $request->all();
        if(!(isset($inputs["delete_flag"]) && $inputs["delete_flag"] == 1)){
            $inputs["delete_flag"] = 0;
        }

        $dispData = [
            'inputs' => $inputs,
        ];

        return view('admin.shopEditInfoConfirm', $dispData);
    }

    public function shopEditInfoComplete(Request $request)
    {
        $inputs = $request->all();

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('admin.showEditShopForm',['shop_id' => $inputs['id']])
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
            $shop->status = $request->input('status');
            $shop->delete_flag = $request->input('delete_flag');
            $shop->save();

            //メールでpdf契約書？

            //送信完了ページのviewを表示
            return view('admin.shopEditInfoComplete');
        }

    }

}
