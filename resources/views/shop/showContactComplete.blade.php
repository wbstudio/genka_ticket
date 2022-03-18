@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/contact.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用メニュー編集完了</h2>
    <div class="regist_compete">
        お問い合わせありがとうございます。<br>
        1営業日以内の返信となるかと思いますので、<br>
        お待ちください。<br>
        <br>
        それでは引き続きよろし奥お願いします。<br>
        <div class="button_area">
            <a href="{{ route('shops.home') }}">
                HOMEへ戻る
            </a>
        </div>
    </div>
</div>
@endsection