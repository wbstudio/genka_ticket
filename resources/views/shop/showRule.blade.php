@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/rule.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket----利用規約</h2>
    <div class="fix_text_area">
    <div class="text_mass">
            <h3>1.ああああああああああああああああ</h3>
            <p>
                お問い合わせありがとうございます。<br>
                1営業日以内の返信となるかと思いますので、<br>
                お待ちください。<br>
                <br>
                それでは引き続きよろし奥お願いします。<br>
            </p>
        </div>
        <div class="text_mass">
            <h3>1.ああああああああああああああああ</h3>
            <p>
                お問い合わせありがとうございます。<br>
                1営業日以内の返信となるかと思いますので、<br>
                お待ちください。<br>
                <br>
                それでは引き続きよろし奥お願いします。<br>
            </p>
        </div>
        <div class="text_mass">
            <h3>1.ああああああああああああああああ</h3>
            <p>
                お問い合わせありがとうございます。<br>
                1営業日以内の返信となるかと思いますので、<br>
                お待ちください。<br>
                <br>
                それでは引き続きよろし奥お願いします。<br>
            </p>
        </div>
        <div class="text_mass">
            <h3>1.ああああああああああああああああ</h3>
            <p>
                お問い合わせありがとうございます。<br>
                1営業日以内の返信となるかと思いますので、<br>
                お待ちください。<br>
                <br>
                それでは引き続きよろし奥お願いします。<br>
            </p>
        </div>
        <div class="text_mass">
            <h3>1.ああああああああああああああああ</h3>
            <p>
                お問い合わせありがとうございます。<br>
                1営業日以内の返信となるかと思いますので、<br>
                お待ちください。<br>
                <br>
                それでは引き続きよろし奥お願いします。<br>
            </p>
        </div>
        <div class="button_area">
            <a href="{{ route('shops.home') }}">
                HOMEへ戻る
            </a>
        </div>
    </div>
</div>
@endsection