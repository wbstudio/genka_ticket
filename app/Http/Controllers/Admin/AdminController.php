<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use \App\Models\Admin;


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

}
