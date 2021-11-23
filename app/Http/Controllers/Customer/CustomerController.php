<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Customer\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //
    public function showLoginForm() {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('customer.'. USER_AGENT .'.login');

    }

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = "customers";

        if(\Auth::guard($guard)->attempt($credentials)) {
                                                                     
            $mdCustomer= new Customer();
            $customerData = $mdCustomer->getCustomerInfoWhenLogin($request->input('email'));
            $request->session()->put('id', $customerData["id"]);
            return redirect('customer/home');

        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    /**
     * ログアウト
     *  - 全セッション削除
     */
    public function logout(Request $request) {

        Auth::logout();
        Session::flush();
        return redirect('customer');
    }

}
