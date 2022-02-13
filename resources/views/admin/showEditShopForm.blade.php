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
<form action="{{ route('admin.shopEditInfoConfirm')}}" method="post">
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
                <input type="text" name="name" value="@if(!empty(old('name'))){{old('name')}}@else{{$adminShopData -> name }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                <input type="text" name="email" value="@if(!empty(old('email'))){{old('email')}}@else{{$adminShopData -> email }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                店舗種別<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="kind" value="@if(!empty(old('kind'))){{old('kind')}}@else{{$adminShopData -> kind }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                カテゴリー<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="category" value="@if(!empty(old('category'))){{old('category')}}@else{{$adminShopData -> category }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                住所<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="adress" value="@if(!empty(old('adress'))){{old('adress')}}@else{{$adminShopData -> adress }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                電話番号<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="text" name="phone" value="@if(!empty(old('phone'))){{old('phone')}}@else{{$adminShopData -> phone }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                営業時間<span class="asterisk">＊</span>
            </th>
            <td>
            <input type="text" name="business_hour" value="@if(!empty(old('business_hour'))){{old('business_hour')}}@else{{$adminShopData -> business_hour }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                xAxis
            </th>
            <td>
                <input type="text" name="xaxis" value="@if(!empty(old('xaxis'))){{old('xaxis')}}@else{{$adminShopData -> xaxis }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                yAxis
            </th>
            <td>
                <input type="text" name="yaxis" value="@if(!empty(old('yaxis'))){{old('yaxis')}}@else{{$adminShopData -> yaxis }}@endif">
            </td>
        </tr>
        <tr>
            <th>
                ステータス
            </th>
            <td>
                <select name="status">
                    <option value="2"  @if((!empty(old("status")) && old("status") == 2))  selected @elseif(empty(old("status")) && $adminShopData['status'] == 2) selected @endif>契約書捺印待ち</option>
                    <option value="3"  @if((!empty(old("status")) && old("status") == 3))  selected @elseif(empty(old("status")) && $adminShopData['status'] == 3) selected @endif>契約中</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>
                削除
            </th>
            <td>
                <input type="checkbox" value="1" name="delete_flag">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    確認画面へ
</button>
<input type="hidden" name="id"  value="{{$adminShopData -> id}}">
</form>
</div>
@endsection