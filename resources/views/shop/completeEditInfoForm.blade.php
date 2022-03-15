@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/info.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket--店舗情報登録完了</h2>
    <div class="regist_compete">
        店舗情報編集が完了しました。<br>
        引き続き「原価ticket」をよろしくお願いします。<br>
        <div class="button_area">
            <a href="{{ route('shops.home')}}">会員HOMEへ戻る</a>
        </div>
    </div>

</div>
@endsection