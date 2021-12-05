@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div>
    Bill画面
</div>
@if(!is_null($subscription))
<div class="text-center">
    <h2 class="mb-5">{{ App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['name'] }} 詳細</h2>
    <div class="mb-5">
        <form action="{{ route('subscription.edit', $subscription->id) }}" method="get">
            <div class="info text-center w-100 mb-10">
                <table class="table mx-auto mb-5">
                    <tr>
                        <th>
                            <p class="font-bold text-right">開始日</p>
                        </th>
                        <td>
                            <p class="text-right">{{ $subscription->start_on->format('Y年m月d日') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="font-bold text-right">継続回数</p>
                        </th>
                        <td>
                            <p class="text-right">{{ $subscription->times }}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <h2 class="mb-5">次回請求情報</h2>
            <div class="info text-center w-100 mb-10">
                <table class="table mx-auto mb-5">
                    <tr>
                        <th>
                            <p class="font-bold text-right">次回請求日</p>
                        </th>
                        <td>
                            <p class="text-right">{{ $subscription->next_payment_on->format('Y年m月d日') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="font-bold text-right">価格</p>
                        </th>
                        <td>
                            <p class="text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="font-bold text-right">数量</p>
                        </th>
                        <td>
                            <p class="text-right">{{ number_format(App\Consts\TicketConsts::SUBSCRIPTION_TICKET_INFO['quantity']) }} 枚</p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="font-bold text-right">合計金額(税込)</p>
                        </th>
                        <td>
                            <p class="text-right">{{ number_format((App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE * App\Consts\CommonConsts::PRICE_TAX_RATE) + App\Consts\TicketConsts::SUBSCRIPTION_TICKET_PRICE) }} 円</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="submit text-center">
                <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">変更する</button>
            </div>
        </form>
    </div>
    <div class="mb-5">
        <form action="{{ route('ticket.create') }}" method="get">
            <div class="submit text-center">
                <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">追加購入する</button>
            </div>
        </form>
    </div>
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