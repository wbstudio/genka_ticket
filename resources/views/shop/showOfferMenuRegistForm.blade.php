@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/menu.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用メニュー登録フォーム</h2>
    <div class="regist_form">
        <form action="{{ route('shops.showOfferMenuRegistConfirm') }}" method="post">
        @csrf
        <table>

            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>

            <tbody>
                <tr>
                    <th>
                        名前
                    </th>
                    <td>
                        <input type="text" name="name" value="{{ old('name')  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        詳細
                    </th>
                    <td>
                        <textarea name="detail">{{old('detail')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        チケット枚数
                    </th>
                    <td>
                        <input type="text" name="ticket" value="2" readonly="readonly">
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