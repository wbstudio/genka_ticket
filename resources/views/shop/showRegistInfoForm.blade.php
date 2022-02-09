@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div>
showRegistInfoForm
<form action="{{ route('shops.confirmInfo') }}" method="post">
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
                店舗名<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="name" value="{{ old('name') }}">
            </td>
        </tr>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                <input type="text" name="email" readonly value="{{$shopData -> email}}">
            </td>
        </tr>
        <tr>
            <th>
                店舗種別<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="kind"  value="{{ old('kind') }}">
            </td>
        </tr>
        <tr>
            <th>
                カテゴリー<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="category" value="{{ old('category') }}">
            </td>
        </tr>
        <tr>
            <th>
                住所<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="adress" value="{{ old('adress') }}">
            </td>
        </tr>
        <tr>
            <th>
                電話番号<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </td>
        </tr>
        <tr>
            <th>
                営業時間<span class="asterisk">＊</span>
            </th>
            <td>
            <input type="text" name="business_hour" value="{{ old('business_hour') }}">
            </td>
        </tr>
        <tr>
            <th>
                xAxis
            </th>
            <td>
                <input type="text" name="xaxis" value="{{ old('xaxis') }}">
            </td>
        </tr>
        <tr>
            <th>
                yAxis
            </th>
            <td>
                <input type="text" name="yaxis" value="{{ old('yaxis') }}">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    確認画面へ
</button>
<input type="hidden" name="id"  value="{{$shopData -> id}}">
</form>
</div>
@endsection