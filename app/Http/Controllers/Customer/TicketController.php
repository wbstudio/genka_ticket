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
        $displayType = $commonController->selectBrowser();
        $page_title = "原チケ-Ticket";
        $page_type = "TICKET";

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
        ];

        return view('customer.'. $displayType .'.ticket', $dispData);

    }

}
