<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use \App\Models\Subscription;

class BillController extends Controller
{
    public function index()
    {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-Bill";
        $page_type = "BILL";

        // ログインユーザーの継続課金データ取得
        $customerId = Auth::id();
        $subscription = Subscription::getSubscription($customerId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'subscription' => $subscription,
        ];
        
        return view('customer.' . USER_AGENT . '.bill', $dispData);
    }
}
