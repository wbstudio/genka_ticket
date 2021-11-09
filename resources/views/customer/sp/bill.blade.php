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
<div class="my-5">
    <p class="mb-5">{{ App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['name'] }}登録済</p>
    
    <p>実装予定:</p>
    <p>・定期チケット詳細画面</p>
    <p>・チケット追加画面</p>
    <p class="mb-10">↓とりあえず、何回も試せるように表示</p>
</div>
<div class="p-1">
    <form action="{{ route('subscription.create') }}" method="get">
        <h2 class="text-center mb-5">{{ App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['name'] }}</h2>
        <div class="discriptions mb-5">
            <ul>
                @foreach (App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['descriptions'] as $description)
                <li>{{ $description }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="cautions mb-5">
            <h4>注意</h4>
            <ul class="text-sm">
                @foreach (App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['cautions'] as $caution)
                <li>{{ $caution }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="price mb-10">
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">価格</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">数量</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['quantity']) }} 枚</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">合計金額(税込)</dd>
                <dt class="w-1/4 text-right">{{ number_format((App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE * App\Consts\CommonConsts::PRICE_TAX_RATE) + App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</dt>
            </dl>
        </div>
        <div class="submit text-center">
            <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">購入する</button>
        </div>
    </form>
</div>

@else
<div class="p-1">
    <form action="{{ route('subscription.create') }}" method="get">
        <h2 class="text-center mb-5">{{ App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['name'] }}</h2>
        <div class="discriptions mb-5">
            <ul>
                @foreach (App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['descriptions'] as $description)
                <li>{{ $description }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="cautions mb-5">
            <h4>注意</h4>
            <ul class="text-sm">
                @foreach (App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['cautions'] as $caution)
                <li>{{ $caution }}</li>
                @endforeach 
            </ul>
        </div>
        <div class="price mb-10">
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">価格</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">数量</dd>
                <dt class="w-1/4 text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['quantity']) }} 枚</dt>
            </dl>
            <dl class="flex">
                <dd class="w-3/4 font-bold text-right">合計金額(税込)</dd>
                <dt class="w-1/4 text-right">{{ number_format((App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE * App\Consts\CommonConsts::PRICE_TAX_RATE) + App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</dt>
            </dl>
        </div>
        <div class="submit text-center">
            <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">購入する</button>
        </div>
    </form>
</div>
@endif
@endsection