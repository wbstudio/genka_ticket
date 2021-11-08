<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // すでにStripeユーザーの場合
        $user = Auth::user();
        $stripe_customer_id = null;
        if (!is_null($user['stripe_customer_id'])) {
            $stripe_customer_id = $user['stripe_customer_id'];
        }

        \Stripe\Stripe::setApiKey('sk_test_51Jk48VHe6td1kE2ZInN4qgkKKiSbfC3vmKwF2YDEsE6PPGLnwQZc5tdPZpvJS25WALRbz33ydtlM1WUyEDmjNbir00vFFRHwoJ');
        header('Content-Type: application/json');
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price' => 'price_1Jo2ohHe6td1kE2ZypMVWKLT', // 継続課金
                'quantity' => 1,
            ]],
            'payment_method_types' => [
                'card',
            ],
            'locale' => 'ja',
            'customer_email' => is_null($user['email']) ? $user['email'] : null,
            'customer' => $stripe_customer_id,
            'mode' => 'subscription',
            'success_url' => env('APP_URL').'/customer/bill',
            'cancel_url' => env('APP_URL').'/customer/bill?session_id={CHECKOUT_SESSION_ID}',
        ]);

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
        //
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
}
