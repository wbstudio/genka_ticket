<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \App\Models\Subscription;
use Carbon\Carbon;

class WebhookController extends CashierController
{
    public function handleCustomerSubscriptionDeleted($payload)
    {
        try {
            // サブスクリプションID取得
            $subscriptionId = $payload['data']['subscription'];

            // サブスクリプションエンティティ取得
            $mbSubscription = new Subscription();
            $subscription = $mbSubscription
                ->where([
                    'stripe_subscription_key' => $subscriptionId,
                    'end_on'                  => null,
                    'delete_flag'             => 0
                ])
                ->first();

            // キャンセル処理
            if (is_null($subscription)) {
                throw new \Exception("no target subscription");
            }
            $todayObj = Carbon::now();
            $subscription->end_on = $todayObj->format('Y-m-d');
            $subscription->delete_flag = 1;

            $subscription->saveOrFail();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            echo($e->getMessage());

            // 失敗レスポンス
            http_response_code(500);
            exit;
        }

        // 成功レスポンス
        http_response_code(200);
    }
}
