<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use \App\Models\Customer\Customer;
class HomeController extends Controller
{
    //
    public function index() {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-HOME";
        $page_type = "HOME";

        $customerId = session('id');
        $mdCustomer= new Customer();
        $customerData = $mdCustomer->getCustomerInfoById($customerId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'customerData' => $customerData,
        ];

        return view('customer.'. USER_AGENT .'.home', $dispData);

    }

}
