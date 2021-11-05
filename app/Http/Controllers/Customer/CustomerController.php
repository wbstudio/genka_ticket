<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Customer\Customer;

class CustomerController extends Controller
{
    //
    public function showLoginForm() {
        $commonController = new CommonController;
        $displayType = $commonController->selectBrowser();
        return view('customer.'. $displayType.'.login');

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

}
