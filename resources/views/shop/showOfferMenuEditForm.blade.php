@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/menu.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用メニュー編集フォーム</h2>
    <div class="edit_form">
        <form action="{{ route('shops.showOfferMenuEditConfirm') }}" method="post">
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
                        <input type="text" name="name" value="@if(!empty(old('name'))){{old('name')}}@else{{$serviceData -> name }}@endif">
                    </td>
                </tr>
                <tr>
                    <th>
                        詳細
                    </th>
                    <td>
                        <textarea name="detail">@if(!empty(old('detail'))){{old('detail')}}@else{{$serviceData -> detail }}@endif</textarea>
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
            <button type="submit" name="action" value="submit" @if($disable_flag == 1) disabled @endif @if($disable_flag == 1) class="disable" @endif >
                確認画面へ
            </button>
        </div>
        <input type="hidden" name="shop_id" value="{{ $shopData -> id }}">
        <input type="hidden" name="service_id" value="{{ $serviceData -> service_id }}">
        </form>
    </div>
</div>
@endsection