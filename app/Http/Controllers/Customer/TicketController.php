<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Models\Subscription;
use \App\Models\Ticket;
use \App\Models\Payment;
use \App\Consts\TicketConsts;
use Carbon\Carbon;
use \App\Models\Customer\Customer;



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

        $customerId = session('id');
        $mdCustomer= new Customer();
        $customerData = $mdCustomer->getCustomerInfoById($customerId);


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ログインユーザー取得
        $customer = Auth::user();
        $customer = Customer::find($customer->id);

        // StripeInit
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
        header('Content-Type: application/json');

        // StripeCheckoutオブジェクト取得
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => env('STRIPE_SINGLE_PRICE_KEY'), // 追加購入
                'adjustable_quantity' => [
                    'enabled' => true,
                    'maximum' => 999,
                    'minimum' => 1
                ],
                'quantity' => 1
            ]],
            'payment_method_types' => [
                'card',
            ],
            'locale' => 'ja',
            'customer_email' => is_null($customer->stripe_customer_key) ? $customer->email : null,
            'customer' => !is_null($customer->stripe_customer_key) ? $customer->stripe_customer_key : null,
            'mode' => 'payment',
            'success_url' => env('APP_URL').'/customer/ticket/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL').'/customer/ticket/cancel',
        ]);

        // Stripeセッションキー保存
        session()->forget('stripe');
        session(['stripe.checkout.session_id' => $checkout_session->id]);
        session(['stripe.checkout.complete' => false]);

        return redirect($checkout_session->url);
    }

    /**
     * Stripe追加購入成功コールバック
     */
    public function success(string $stripeSessionId)
    {
        // 遷移元セッションキー取得
        $originStripeSessionId = session('stripe.checkout.session_id');

        // StripeCheckoutステータス
        $complete = session('stripe.checkout.complete');

        // セッションキーが異なる場合
        if (!$complete && ($stripeSessionId !== $originStripeSessionId)) {
            return redirect(route('customer.bill'))->with('flash_message', '不正なアクセスです');
        }

        // 支払いが完了しているかチェック
        if (!$complete) {
            $stripeChargeId = null;

            // StripeInit
            $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
            header('Content-Type: application/json');
            $checkout_session = $stripe->checkout->sessions->retrieve(
                $stripeSessionId,
                []
            );

            $payment_intent = $stripe->paymentIntents->retrieve(
                $checkout_session->payment_intent,
                []
            );
            $stripeChargeId = $payment_intent->charges->data[0]->id;

            // 支払トランザクションキーが存在しない場合、Billページにリダイレクト
            if (is_null($stripeChargeId)) {
                return redirect(route('customer.bill'))->with('flash_message', '支払いに失敗しました。再度お試しください。');
            }

            // データ保存処理
            $item = $stripe->checkout->sessions->allLineItems($stripeSessionId, ['limit' => 1]);
            $ticketQuantity = $item->data[0]->quantity;
            $amount = $item->data[0]->amount_total;

            DB::beginTransaction();
            try {
                // ログインユーザー取得
                $customer = Auth::user();
                $customer = Customer::find($customer->id);

                // 支払トランザクションの保存
                $payment = Payment::create([
                    'customer_id'       => $customer->id,
                    'email'             => $customer->email,
                    'stripe_charge_key' => $stripeChargeId,
                    'kind'              => TicketConsts::TICKET_PAYMENT_KIND['SINGLE'],
                    'quantity'          => $ticketQuantity,
                    'amount'            => $amount,
                ]);

                // チケットトランザクションの保存
                $ticket = Ticket::create([
                    'customer_id' => $customer->id,
                    'payment_id'  => $payment->id,
                    'count'       => $ticketQuantity,
                    'status'      => TicketConsts::TICKET_STATUS['SINGLE'],
                ]);

                // ユーザーの保有チケット枚数の更新
                $customer = Customer::find($customer->id);
                $customer->ticket = $customer->ticket + $ticketQuantity;
                // StripeCustomerの設定がない場合、ユーザーに紐付ける
                if (is_null($customer->stripe_customer_key)) {
                    $customer->stripe_customer_key = $checkout_session->customer;
                }
                $customer->saveOrFail();

                DB::commit();
                // セッション初期化
                session(['stripe.checkout.complete' => true]);
                session()->forget('stripe.checkout.session_id');
            } catch (\Exception $e) {
                DB::rollback();
                Log::debug($e->getMessage());
                return redirect(route('customer.bill'))->with('flash_message', '支払いに失敗しました。再度お試しください。');
            }
        }

        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('customer.' . USER_AGENT . '.ticket.success');
    }

    /**
     * Stripe継続課金処理キャンセル
     */
    public function cancel()
    {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('customer.' . USER_AGENT . '.ticket.cancel');
    }

}
