<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;

class CustomerController extends Controller
{
    //
    public function showLoginForm() {
        CommonController::selectBrowser();
        return view('customer.'. USER_AGENT.'.login');

    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = "customers";

        if(\Auth::guard($guard)->attempt($credentials)) {

            return redirect('customer/home');

        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

}
