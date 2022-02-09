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
<form action="{{ route('shops.completeInfo') }}" method="post">
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
                店舗名
            </th>
            <td>
                {{ $inputs['name'] }}
                <input type="hidden" name="name" value="{{ $inputs['name'] }}">
            </td>
        </tr>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                {{$shopData -> email}}
                <input type="hidden" name="email" readonly value="{{$shopData -> email}}">
            </td>
        </tr>
        <tr>
            <th>
                店舗種別
            </th>
            <td>
                {{ $inputs['kind'] }}
                <input type="hidden" name="kind"  value="{{ $inputs['kind'] }}">
            </td>
        </tr>
        <tr>
            <th>
                カテゴリー
            </th>
            <td>
                {{ $inputs['category'] }}
                <input type="hidden" name="category" value="{{ $inputs['category'] }}">
            </td>
        </tr>
        <tr>
            <th>
                住所
            </th>
            <td>
                {{ $inputs['adress'] }}
                <input type="hidden" name="adress" value="{{ $inputs['adress'] }}">
            </td>
        </tr>
        <tr>
            <th>
                電話番号
            </th>
            <td>
                {{ $inputs['phone'] }}
                <input type="hidden" name="phone" value="{{ $inputs['phone'] }}">
            </td>
        </tr>
        <tr>
            <th>
                営業時間
            </th>
            <td>
                {{ $inputs['business_hour'] }}
                <input type="hidden" name="business_hour" value="{{ $inputs['business_hour'] }}">
            </td>
        </tr>
        <tr>
            <th>
                xAxis
            </th>
            <td>
                {{ $inputs['xaxis'] }}
                <input type="hidden" name="xaxis" value="{{ $inputs['xaxis'] }}">
            </td>
        </tr>
        <tr>
            <th>
                yAxis
            </th>
            <td>
                {{ $inputs['yaxis'] }}
                <input type="hidden" name="yaxis" value="{{ $inputs['yaxis'] }}">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="back">
    入力内容修正
</button>
<button type="submit" name="action" value="submit">
    送信する
</button>
<input type="hidden" name="id"  value="{{$shopData -> id}}">
</form>
</div>
@endsection