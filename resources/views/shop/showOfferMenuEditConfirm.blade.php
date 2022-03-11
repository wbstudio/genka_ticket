@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<form action="{{ route('shops.showOfferMenuEditComplete') }}" method="post">
@csrf
<table>
    <thead>
        <tr>
            <th>

            </th>
            <td>

            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                名前
            </th>
            <td>
                {{ $inputs ['name']  }}
                <input type="hidden" name="name" value="{{ $inputs ['name']  }}">
            </td>
        </tr>
        <tr>
            <th>
                詳細
            </th>
            <td>
                {!! nl2br(e($inputs ['detail'])) !!}
                <input type="hidden" name="detail" value='{{$inputs ["detail"]}}'>
            </td>
        </tr>
        <tr>
            <th>
                チケット枚数
            </th>
            <td>
                2枚
                <input type="hidden" name="ticket" value="2" readonly="readonly">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    登録する
</button>
<button type="submit" name="back" value="submit">
    戻る
</button>
<input type="hidden" name="shop_id" value="{{ $shopData -> id }}">
<input type="hidden" name="service_id" value="{{$inputs ['service_id']}}">
</form>
@endsection