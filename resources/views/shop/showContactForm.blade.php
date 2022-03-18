@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/contact.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket--お問い合わせフォーム</h2>
    @if($errors->any())
        <ul class="error_message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

    <div class="regist_form">
        <form action="{{ route('shops.showContactConfirm') }}" method="post">
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
                        <input type="text" name="name" value="{{ $shopData -> name }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th>
                        アドレス
                    </th>
                    <td>
                        <input type="text" name="email" value="@if(!empty(old('email'))) {{ old('email') }} @else {{$shopData -> email}} @endif">
                    </td>
                </tr>
                <tr>
                    <th>
                        件名
                    </th>
                    <td>
                        <input type="text" name="title" value="{{ old('title')  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        内容
                    </th>
                    <td>
                        <textarea name="main">{{old('main')}}</textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                登録する
            </button>
        </div>
        <input type="hidden" name="shop_id" value="{{ $shopData -> id }}">
        </form>
    </div>
</div>
@endsection