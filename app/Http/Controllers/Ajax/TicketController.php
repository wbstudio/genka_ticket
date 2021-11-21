<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Customer\Ticket;
use \App\Models\Customer\Customer;

class TicketController extends Controller
{
    //
    public function insertUseTicketData($shop_id,$service_id,$ticket_count,$customer_id){


        /**
         * responseについて
         * ticket成功→result = true
         * 枚数足りない→result = false, status = 0
         * パラメーター不正→result = false, status = 1
        */
        $result = false;
        $status = 1;
        //
        if(isset($shop_id) && isset($service_id) && isset($ticket_count) && isset($customer_id) && (session('id') == $customer_id)){

            $mdCustomer = new Customer();
            $customerDate = $mdCustomer->getCustomerInfoById($customer_id);

            if($customerDate -> ticket >= $ticket_count){

                //ticketテーブル
                $mdTicket = new Ticket();
                $mdTicket->shop_id = $shop_id;
                $mdTicket->service_id = $service_id;
                $mdTicket->customer_id = $customer_id;
                $mdTicket->count = $ticket_count;
                $mdTicket->status = 0;
                $mdTicket->delete_flag = 0;
                $mdTicket->save();

                //customerテーブル
                $mdCustomer = Customer::where("id",$customer_id)->first();
                $mdCustomer->ticket = (int)$customerDate -> ticket - (int)$ticket_count;
                $mdCustomer->save();

                $result = true;
            }
            $status = 0;
        }

        $response = array(
            'result' => $result,
            'status' => $status,
        );

        return response()->json($response);

    }

}
