@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('css/customer/sp/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endsection

@section('content')
<div>
    <div class="home_title">
        {{$customerData -> name}}さんのマイページ<br>
        <span class="home_ticket">(残りチケット&nbsp;:&nbsp;{{$customerData -> ticket}}枚)</span>
    </div>

    <div>
        <div>お知らせ</div>
        <div>現在お知らせはありません</div>
    </div>

    <div id="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_01.png')}}" class="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_02.png')}}" class="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_03.png')}}" class="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_04.png')}}" class="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_05.png')}}" class="">
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="swiper-slide_inner">
                        <a href="">
                            <img src="{{ asset('images/customer/sp/top_slider/slider_06.png')}}" class="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>        
        </div>
        <script>
            const mySwiper = new Swiper('.swiper-container', {
                slidesPerView:1.1,
                centeredSlides : true,
                spaceBetween: 6,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            })
        </script>

    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>Ticket利用<span class="sub_title">(QR読み取り)</span></h2>
        <div>
            <p>
                お店で発行されているQRコードを次のページで読み取れば<br>
                簡単にチケット利用できます。
            </p>
            <div class="button_area">
                <a href="">Ticketを使う</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>駅・カテゴリーから検索</h2>
        <div>
            <p>
                駅名、カテゴリーで絞り込んであなた好みのお店を検索できます。
            </p>
            <div class="button_area">
                <a href="">お店を検索</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>現在地からお店を検索<span class="sub_title">(Map機能)</span></h2>
        <div>
            <p>
                GoogleMap上のアイコンを押すとお店の情報が表示されて簡単にイイ感じのお店を検索できます。
            </p>
            <div class="button_area">
                <a href="">Map機能を使う</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>使い方で困ったら<span class="sub_title">(原チケの使い方)</span></h2>
        <div>
            <p>
                原価チケットを使ってくれてありがとうございます。<br>
                感謝の気持ちを込めて、そして末永くお付き合いしていきたいと思い、<br>
                できるだけ分かりやすく使い方を書いてみました。<br>
                ぜひ見てみてください。                
            </p>
            <div class="button_area wide_button">
                <a href="">原チケの使い方を見てみる</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>お問い合わせ</h2>
        <div>
            <p>
                分からないこと、困ったこと、こんな機能があるともっといいのにと言った<br>
                ご意見、ご感想をどしどしお送りください。
            </p>
            <div class="button_area wide_button">
                <a href="">問い合わせ画面へ</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>

    <div id="home_qr">
        <h2>りれき</h2>
        <div>
            <p>
                お店で発行されているQRコードを次のページで読み取れば<br>
                簡単にチケット利用できます。
            </p>
            <div class="button_area">
                <a href="">Ticketを使う</a>
            </div>
        </div>
    </div>

    <div class="partition"></div>


</div>
@endsection