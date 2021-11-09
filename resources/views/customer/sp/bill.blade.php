@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div>
    Bill画面
</div>
@if(count($subscriptions) > 0)
<p>あり</p>
@else
<div class="p-1">
    <form action="{{ route('subscription.create') }}" method="get">
        <h2 class="text-center mb-5">{{ App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['name'] }}</h2>
        <div class="discriptions mb-5">
            <ul>
                @foreach (App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['descriptions'] as $description)
                <li>{{ $description }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="cautions mb-5">
            <h4>注意</h4>
            <ul class="text-sm">
                @foreach (App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['cautions'] as $caution)
                <li>{{ $caution }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="price mb-10">
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">価格</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['unit_price']) }} 円</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">数量</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['quantity']) }} 枚</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">合計金額(税込)</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['unit_price'] * App\Consts\ProductConsts::SUBSCRIPTION_PRODUCT['quantity'] * (1 + App\Consts\ProductConsts::PRICE_TAX_RATE)) }} 円</dt>
            </dl>
        </div>
        <div class="submit text-center">
            <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">購入する</button>
        </div>
    </form>
</div>
@endif
@endsection