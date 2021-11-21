<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;


class TicketController extends Controller
{
    //
        //
    public function index() {
        //SP/PC切り替え--customerページでのみ利用（その他はPCのみ作成でOK）
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-Ticket";
        $page_type = "TICKET";
        $customerData["customer_id"] = session('id');


        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'customerData' => $customerData,
        ];

        return view('customer.'. USER_AGENT .'.ticket', $dispData);

    }

    public function thanks() {
        //SP/PC切り替え--customerページでのみ利用（その他はPCのみ作成でOK）
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-Ticket";
        $page_type = "TICKET";
        $customerData["customer_id"] = session('id');


        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'customerData' => $customerData,
        ];

        return view('customer.'. USER_AGENT .'.ticket_thanks', $dispData);

    }

    public function shortage() {
        //SP/PC切り替え--customerページでのみ利用（その他はPCのみ作成でOK）
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-Ticket";
        $page_type = "TICKET";
        $customerData["customer_id"] = session('id');


        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'customerData' => $customerData,
        ];

        return view('customer.'. USER_AGENT .'.ticket_shortage', $dispData);

    }

}
