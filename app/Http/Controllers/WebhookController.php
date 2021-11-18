<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookController extends CashierController
{
    public function handleCustomerSubscriptionDeleted($payload)
    {
        // $event = \Stripe\Event::constructFrom(
        //     json_decode($payload, true)
        // );

        Log::debug($payload);

        // サブスクリプションID取得
        // サブスクリプションエンティティ取得
        // キャンセル処理

        http_response_code(200);
    }
}
