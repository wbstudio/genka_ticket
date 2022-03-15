@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/info.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket--店舗情報登録確認画面</h2>
    <div class="regist_confirm">
        <form action="{{ route('shops.completeEditInfo') }}" method="post">
        @csrf
        <table>
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
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
                        {{ $inputs['kind_str'] }}
                        <input type="hidden" name="kind"  value="{{ $inputs['kind'] }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        カテゴリー
                    </th>
                    <td>
                        {{ $inputs['category_str'] }}
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
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                登録する
            </button>
            <button type="submit" name="action" value="back">
                戻る
            </button>
        </div>
            <input type="hidden" name="id"  value="{{$shopData -> id}}">
        </form>
    </div>
</div>
@endsection