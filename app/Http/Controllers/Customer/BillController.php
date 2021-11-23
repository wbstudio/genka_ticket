<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;
use \App\Models\Subscription;
use \App\Models\Ticket;
use \App\Consts\TicketConsts;

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

        // 追加購入データ取得
        $tickets = Ticket::getTicketLogs($customerId, TicketConsts::TICKET_STATUS['SINGLE']);

        $dispData = [
            'pageTitle'    => $page_title,
            'pageType'     => $page_type,
            'subscription' => $subscription,
            'tickets'      => $tickets
        ];
        
        return view('customer.' . USER_AGENT . '.bill', $dispData);
    }
}
