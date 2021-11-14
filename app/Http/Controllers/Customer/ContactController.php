<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Customer\Customer;
use \App\Models\Customer\Contact_customer;

class ContactController extends Controller
{
    //
    public function index() {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-CONTACT";
        $page_type = "CONTACT";

        $customerId = session('id');
        $mdCustomer= new Customer();
        $customerData = $mdCustomer->getCustomerInfoById($customerId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'customerData' => $customerData,
        ];

        return view('customer.'. USER_AGENT .'.contact_form', $dispData);

    }

    public function confirm(Request $request) {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-CONTACT";
        $page_type = "CONTACT";

        $inputs = $request->all();

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'inputs' => $inputs,
        ];

        return view('customer.'. USER_AGENT .'.contact_confirm', $dispData);

    }

    public function send(Request $request) {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-CONTACT";
        $page_type = "CONTACT";

        $inputs = $request->all();

        $customerId = session('id');

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'inputs' => $inputs,
        ];

        $action = $request->input('action');  
        $inputs = $request->except('action');

        if($action !== 'submit'){

            return redirect()
                ->route('customer.contact')
                ->withInput($inputs);

        } else {

            //入力されたメールアドレスにメールを送信
            // \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            $mdContactC = new Contact_customer();
            $mdContactC->email = $request->input('email');
            $mdContactC->customer_id = $customerId;
            $mdContactC->main = $request->input('main');
            $mdContactC->status = 0;
            $mdContactC->save();

            //送信完了ページのviewを表示
            return view('customer.'. USER_AGENT .'.contact_thanks', $dispData);

        }

    }

}
