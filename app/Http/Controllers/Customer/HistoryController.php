<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Ticket;
use \App\Models\Payment;
use \App\Consts\TicketConsts;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    //
    public function index() {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-HISTORY";
        $page_type = "HISTORY";

        // 課金履歴を取得
        $customerId = Auth::id();
        $payments = Payment::getPaymentLogs($customerId);

        // チケット利用履歴を取得
        $tickets = Ticket::getUsageHistory($customerId);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'payments' => $payments,
            'tickets' => $tickets
        ];

        return view('customer.'. USER_AGENT .'.history', $dispData);

    }

}
