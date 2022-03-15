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
        店舗情報登録、誠にありがとうございます。<br>
        原価ticket運営の方で内容確認をし、<br>
        メールにて契約書などの連絡を差し上げますので、<br>
        少々お待ちください。<br>
        引き続きよろしくお願いします。<br>
    </div>

</div>
@endsection