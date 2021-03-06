@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/info.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket--店舗情報登録フォーム</h2>
    <div class="regist_form">
        @if($errors->any())
        <ul class="error_message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="{{ route('shops.confirmInfo') }}" method="post">
        @csrf
        <table>
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
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
                        <select class="kind" name="kind">
                            <option value="">種別</option>
                            @foreach(Config::get('shop.kind') as $key => $kind)
                                <option value="{{$key}}" @if(old('kind') != NULL && old('kind') == $key) selected @endif>{{$kind}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        カテゴリー<span class="asterisk">＊</span>
                    </th>
                    <td>
                        <select class="category" name="category">
                            <option value="">カテゴリー</option>
                            @foreach(Config::get('shop.category') as $key => $category)
                                <option value="{{$key}}" @if(old('category') != NULL && old('category') == $key) selected @endif>{{$category}}</option>
                            @endforeach
                        </select>
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
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                確認画面へ
            </button>
        </div>
        <input type="hidden" name="id"  value="{{$shopData -> id}}">
        </form>
    </div>
</div>
@endsection