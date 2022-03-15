@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/menu.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用メニュー編集確認画面</h2>
    <div class="edit_confirm">
        <form action="{{ route('shops.showOfferMenuEditComplete') }}" method="post">
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
                        {{ $inputs ['name']  }}
                        <input type="hidden" name="name" value="{{ $inputs ['name']  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        詳細
                    </th>
                    <td>
                        {!! nl2br(e($inputs ['detail'])) !!}
                        <input type="hidden" name="detail" value='{{$inputs ["detail"]}}'>
                    </td>
                </tr>
                <tr>
                    <th>
                        チケット枚数
                    </th>
                    <td>
                        2枚
                        <input type="hidden" name="ticket" value="2" readonly="readonly">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button_area">
            <button type="submit" name="action" value="submit">
                登録する
            </button>
            <button type="submit" name="back" value="submit">
                戻る
            </button>
        </div>
        <input type="hidden" name="shop_id" value="{{ $shopData -> id }}">
        <input type="hidden" name="service_id" value="{{$inputs ['service_id']}}">
        </form>
    </div>
</div>
@endsection