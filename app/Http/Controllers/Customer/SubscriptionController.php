<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Models\Customer;
use \App\Models\Subscription;
use \App\Models\Ticket;
use \App\Models\Payment;
use \App\Consts\TicketConsts;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'price' => env('STRIPE_SUBSCRIPTION_PRICE_KEY'), // 継続課金
                'quantity' => 1,
            ]],
            'payment_method_types' => [
                'card',
            ],
            'locale' => 'ja',
            'customer_email' => is_null($customer->stripe_customer_key) ? $customer->email : null,
            'customer' => !is_null($customer->stripe_customer_key) ? $customer->stripe_customer_key : null,
            'mode' => 'subscription',
            'success_url' => env('APP_URL').'/customer/subscription/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL').'/customer/subscription/cancel',
        ]);

        // Stripeセッションキー保存
        session()->forget('stripe');
        session(['stripe.checkout.session_id' => $checkout_session->id]);
        session(['stripe.checkout.complete' => false]);

        return redirect($checkout_session->url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ログインユーザー取得
        $subscription = Subscription::find($id);
        $customer = Customer::find($subscription->customer_id);

        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

        // Authenticate your user.
        $session = \Stripe\BillingPortal\Session::create([
            'customer' => $customer->stripe_customer_key,
            'return_url' => env('APP_URL').'/customer/bill',
        ]);

        // Redirect to the customer portal.
        header("Location: " . $session->url);
        exit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Stripe継続課金成功コールバック
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

            // Stripe継続課金データ
            $subscription = null;
            if (!is_null($checkout_session->subscription)) {
                $subscription = $stripe->subscriptions->retrieve(
                    $checkout_session->subscription,
                    []
                );
            }

            // Stripe請求データ
            $invoice = null;
            if (!is_null($subscription->latest_invoice)) {
                $invoice = $stripe->invoices->retrieve(
                    $subscription->latest_invoice,
                    []
                );
            }

            // 支払トランザクションキー
            $stripeChargeId = $invoice->charge ?? null;

            // 支払トランザクションキーが存在しない場合、Billページにリダイレクト
            if (is_null($stripeChargeId)) {
                return redirect(route('customer.bill'))->with('flash_message', '支払いに失敗しました。再度お試しください。');
            }

            // データ保存処理
            $item = $stripe->checkout->sessions->allLineItems($stripeSessionId, ['limit' => 1]);
            $ticketQuantity = TicketConsts::SUBSCRIPTION_TICKET_INFO['quantity'];
            $amount = $item->data[0]->amount_total;

            DB::beginTransaction();
            try {
                // ログインユーザー取得
                $customer = Auth::user();
                $customer = Customer::find($customer->id);

                // サブスクリプションの場合、継続課金用データの保存
                $todayObj = Carbon::now();
                $nextPaymentDayObj = Carbon::now()->addMonthNoOverflow(1);
                $subscription = Subscription::create([
                    'customer_id'             => $customer->id,
                    'email'                   => $customer->email,
                    'stripe_subscription_key' => $checkout_session->subscription,
                    'start_on'                => $todayObj->format('Y-m-d'),
                    'next_payment_on'         => $nextPaymentDayObj->format('Y-m-d')
                ]);

                // 支払トランザクションの保存
                $payment = Payment::create([
                    'customer_id'       => $customer->id,
                    'email'             => $customer->email,
                    'subscription_id'   => $subscription->id,
                    'stripe_charge_key' => $stripeChargeId,
                    'kind'              => TicketConsts::TICKET_PAYMENT_KIND['SUBSCRIPTION'],
                    'quantity'          => $ticketQuantity,
                    'amount'            => $amount,
                ]);

                // チケットトランザクションの保存
                $ticket = Ticket::create([
                    'customer_id' => $customer->id,
                    'payment_id'  => $payment->id,
                    'count'       => $ticketQuantity,
                    'status'      => TicketConsts::TICKET_STATUS['SUBSCRIPTION'],
                ]);

                // ユーザーの保有チケット枚数の更新
                $customer = Customer::find($customer->id);
                $customer->ticket = $customer->ticket + $ticketQuantity;
                // StripeCustomerの設定がない場合、ユーザーに紐付ける
                if (is_null($customer->stripe_customer_key)) {
                    $customer->email = $checkout_session->customer_email;
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
        return view('customer.' . USER_AGENT . '.subscription.success');
    }

    /**
     * Stripe継続課金処理キャンセル
     */
    public function cancel()
    {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('customer.' . USER_AGENT . '.subscription.cancel');
    }

}
