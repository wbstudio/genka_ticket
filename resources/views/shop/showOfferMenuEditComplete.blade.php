@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/menu.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用メニュー編集完了</h2>
    <div class="edit_compete">
        メニュー編集が完了しました。<br>
        本日もよろしくお願いいたします。<br>
        <div class="button_area">
            <a href="{{ route('shops.offer_menu') }}">
                原価ticket用メニュー一覧へ戻る
            </a>
        </div>
    </div>
</div>
@endsection