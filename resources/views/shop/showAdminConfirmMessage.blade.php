@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/info.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket--店舗情報確認中</h2>
    <div class="regist_compete">
        <p>
            店舗情報登録、誠にありがとうございます。<br>
            只今、原価ticket運営の方で内容確認をしておりますので、<br>
            今しばらくお待ちください。<br>
            引き続きよろしくお願いします。<br>
        </p>

        <p>
            何か質問などがございましたら、<br>
            お気軽にお問い合わせください。<br>
            よろしくお願いします。<br>
        </p>
        <div class="button_area">
            <a href="{{ route('shops.showContactForm') }}">
                お問い合わせページへ
            </a>
        </div>

    </div>

</div>
@endsection