@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/ticket.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/shop/menu.js') }}"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">ticket履歴</h2>
    <div class="ticket_list">
        <div class="month_select">
            <table>
                <colgroup>
                    <col style="width:33%;">
                    <col style="width:33%;">
                    <col style="width:33%;">
                </colgroup>
                <tbody>
                    <tr>
                        <td>
                            <a href="{{route('shops.showTicketList',['month' => $monthData ['back']])}}">＜＜前月</a>
                        </td>
                        <td>
                            {{$monthData['current_str'] }}
                        </td>
                        <td>
                            @isset($monthData['forward'])
                                <a href="{{route('shops.showTicketList',['month' => $monthData['forward']])}}">翌月＞＞</a>
                            @endisset
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table_area">
        @if(count($shopTicketList) > 0)
        <table>
            <colgroup>
                <col style="width:15%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:25%;">
            </colgroup>
            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        利用者ID
                    </td>
                    <td>
                        MenuId
                    </td>
                    <td>
                        利用枚数
                    </td>
                    <td>
                        利用時間
                    </td>
                </tr>
            </thead>
            <tbody>
            @foreach($shopTicketList as $ticketData)
                <tr>
                    <td>
                        {{$ticketData -> id}}
                    </td>
                    <td class="dt_title">
                        {{$ticketData -> customer_id}}
                    </td>
                    <td>
                        {{$ticketData -> service_id}}
                    </td>
                    <td>
                        {{$ticketData -> count}}
                    </td>
                    <td>
                        {{$ticketData -> created_at -> format('Y/m/d H:i')}}
                    </td>
                </tr>
            @endforeach
            </tbody>           
        </table>
        @else
        <div class="error_message">
            {{$monthData['current_str'] }}のticket利用履歴はありません。
        </div>
        @endif
        </div>

        <div id="pagenator">
            @isset($pagenator->firstPageNum)
                <a href="{{route('shops.showTicketList',['month' => $monthData ['current'] , 'page' => $pagenator->firstPageNum])}}">最初</a>
            @endisset
            @isset($pagenator -> prePageNum)
                <a href="{{route('shops.showTicketList',['month' => $monthData ['current'] , 'page' => $pagenator->prePageNum])}}">前へ</a>
            @endisset
            @isset($pagenator -> firstPageNum)
            ...
            @endisset
            @isset($pagenator -> linkNum)
                @foreach($pagenator -> linkNum as $key => $Num)
                @if($page == $Num)
                <span>{{$Num}}</span>
                @else
                <a href="{{route('shops.showTicketList',['month' => $monthData ['current'] , 'page' => $Num])}}">{{$Num}}</a>
                @endif
                @endforeach
            @endisset
            @isset($pagenator->lastPageNum)
            ...
            @endisset
            @isset($pagenator -> nextPageNum)
            <a href="{{route('shops.showTicketList',['month' => $monthData ['current'] , 'page' => $pagenator->nextPageNum])}}">次へ</a>
            @endisset
            @isset($pagenator -> lastPageNum)
            <a href="{{route('shops.showTicketList',['month' => $monthData ['current'] , 'page' => $pagenator->lastPageNum])}}">最後</a>
            @endisset
        </div>

    </div>

</div>

@endsection



