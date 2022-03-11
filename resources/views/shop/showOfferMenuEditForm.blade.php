@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<form action="{{ route('shops.showOfferMenuEditConfirm') }}" method="post">
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
                <input type="text" name="name" value="@if(!empty(old('name'))){{old('name')}}@else{{$serviceData -> name }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                詳細
            </th>
            <td>
                <textarea name="detail">@if(!empty(old('detail'))){{old('detail')}}@else{{$serviceData -> detail }}@endif</textarea>
            </td>
        </tr>
        <tr>
            <th>
                チケット枚数
            </th>
            <td>
                <input type="text" name="ticket" value="2" readonly="readonly">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit" @if($disable_flag == 1) disabled @endif>
    登録する
</button>
<input type="hidden" name="shop_id" value="{{ $shopData -> id }}">
<input type="hidden" name="service_id" value="{{ $serviceData -> service_id }}">
</form>
@endsection