<?php

namespace App\Http\Controllers\Shops;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Customer\Shop;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    //
    public function showLoginForm()
    {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('shop.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $guard = "shops";

        if (\Auth::guard($guard)->attempt($credentials)) {

            // $mdShop = new Shop();
            // $shopData = $mdShop->getCustomerInfoWhenLogin($request->input('email'));
            // $request->session()->put('id', $shopData["id"]);
            // return redirect('shop/admin/home');
            var_dump("logIn Success");
            exit();
        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

}
