@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div>
    history画面
</div>
<div class="mb-5">
    <h2 class="text-xl mb-5 border-b-4 border-double border-black">チケット利用履歴</h2>
    <div class="bg-gray-200 p-1">
        @if(count($tickets) > 0)
        <table class="mb-4 mx-auto text-center w-full border-collapse">
            <tr>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">利用日</th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">数量</th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">サービス</th>
            </tr>
            @foreach ($tickets as $key => $ticket)
            <tr>
                <td class="border-b border-grey-light">{{ $key + 1 }}</td>
                <td class="border-b border-grey-light">
                    <p class="font-bold text-right">{{ $ticket->created_at->format('Y年m月d日') }}</p>
                </td>
                <td class="border-b border-grey-light">
                    <p class="text-right">{{ number_format($ticket->count) }} 枚</p>
                </td>
                <td class="border-b border-grey-light">
                    <p class="text-right">{{ $ticket->service->name }}</p>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p>利用履歴がありません</p>
        @endif
    </div>
</div>
<div class="mb-5">
    <h2 class="text-xl mb-5 border-b-4 border-double border-black">課金履歴</h2>
    <div class="bg-gray-200 p-1">

        @if(count($payments) > 0)
        <table class="mb-4 mx-auto text-center w-full border-collapse">
            <tr>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">課金内容</th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">課金日</th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">数量</th>
                <th class="bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">合計金額（税込）</th>
            </tr>
            @foreach ($payments as $key => $payment)
            <tr>
                <td class="border-b border-grey-light">{{ $key + 1 }}</td>
                <td class="border-b border-grey-light">
                    <p class="font-bold text-right">{{ is_null($payment->subscription_id) ? '追加購入' : '継続課金' }}</p>
                </td>
                <td class="border-b border-grey-light">
                    <p class="font-bold text-right">{{ $payment->created_at->format('Y年m月d日') }}</p>
                </td>
                <td class="border-b border-grey-light">
                    <p class="text-right">{{ number_format($payment->quantity) }} 枚</p>
                </td>
                <td class="border-b border-grey-light">
                    <p class="text-right">{{ number_format($payment->amount) }} 円</p>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p>課金履歴がありません</p>
        @endif
    </div>
</div>
@endsection