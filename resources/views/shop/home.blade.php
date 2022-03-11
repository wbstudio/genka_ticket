@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">


    <div class="menu_list">
        <h2 class="title">原価ticket用メニュー</h2>
        <table>
            <colgroup> 
                <col style='width: 10%;'>
                <col style='width: 40%;'>
                <col style='width: 25%;'>
                <col style='width: 25%;'>
            </colgroup>
            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        タイトル
                    </td>
                    <td>
                        登録時間
                    </td>
                    <td>
                        更新時間
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        00000
                    </td>
                    <td class="dt_title">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td class="dt_title">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td class="dt_title">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button_area">
            <a href="{{ route('shops.offer_menu') }}">メニューページへ</a>
        </div>
    </div>

    <div class="separater"></div>

    <div class="shop_info">
        <h2 class="title">店舗情報</h2>
        <table>
            <colgroup> 
                <col style='width: 25%;'>
                <col style='width: 75%;'>
            </colgroup>
            <tbody>
                <tr>
                    <td>
                        店舗名
                    </td>
                    <td class="dt_name">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                </tr>
                <tr>
                    <td>
                        登録アドレス
                    </td>
                    <td class="dt_email">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX@XXXXXXXXXXX
                    </td>
                </tr>
                <tr>
                    <td>
                        カテゴリー
                    </td>
                    <td class="dt_name">
                        XXXXXXXXXXXXXXXX
                    </td>
                </tr>
                <tr>
                    <td>
                        住所
                    </td>
                    <td class="dt_name">
                        東京都〇〇〇区〇〇00-00-00　○○○○○○○○○○○○　○F
                    </td>
                </tr>
                <tr>
                    <td>
                        電話番号
                    </td>
                    <td class="dt_name">
                        00-0000-0000
                    </td>
                </tr>
                <tr>
                    <td>
                        営業時間
                    </td>
                    <td class="dt_name">
                        00:00~00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        X軸
                    </td>
                    <td class="dt_name">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                </tr>
                <tr>
                    <td>
                        Y軸
                    </td>
                    <td class="dt_name">
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button_area">
            <a href="{{ route('shops.offer_menu') }}">メニューページへ</a>
        </div>
    </div>

    <div class="separater"></div>

    <div class="ticket_list">
        <h2 class="title">今月のticket履歴</h2>
        <table>
            <colgroup> 
                <col style='width: 15%;'>
                <col style='width: 20%;'>
                <col style='width: 20%;'>
                <col style='width: 20%;'>
                <col style='width: 25%;'>
            </colgroup>

            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        利用者ID
                    </td>
                    <td>
                        利用MenuID
                    </td>
                    <td>
                        利用枚数
                    </td>
                    <td>
                        利用時間
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
                <tr>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00000
                    </td>
                    <td>
                        00枚
                    </td>
                    <td>
                        0000-00-00 00:00
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="any_count">他〇〇枚利用されています</div>
        <div class="button_area">
            <a href="{{ route('shops.offer_menu') }}">ticketページへ</a>
        </div>
    </div>

    <div class="separater"></div>

    <div class="contact_area">
        <h2 class="title">お問い合わせ</h2>
        <div>
            <p>
                <span>毎日の営業お疲れ様です。</span><br>             
                <span>原価ticketをご利用くださり、</span><br>
                <span>誠にありがとうございます。</span>
            </p>
            <ul>
                <li>疑問・質問</li>
                <li>店舗情報の修正</li>
                <li>ほしい機能</li>
            </ul>
            <p>
                <span>...等、お気づきの点がありましたら、</span><br>             
                <span>お気軽にお問い合わせください。</span><br>
            </p>
        </div>
        <div class="button_area">
            <a href="{{ route('shops.offer_menu') }}">お問い合わせページへ</a>
        </div>
    </div>



</div>
@endsection