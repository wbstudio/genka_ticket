@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/contact.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket用--確認画面</h2>
    <div class="regist_confirm">
        <form action="{{ route('shops.showContactComplete') }}" method="post">
        @csrf
        <table>
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>
            <tbody>
            <tr>
                    <th>
                        店舗名
                    </th>
                    <td>
                        {{ $inputs ['name']  }}
                        <input type="hidden" name="name" value="{{ $inputs ['name']  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        アドレス
                    </th>
                    <td>
                        {{ $inputs ['email']  }}
                        <input type="hidden" name="email" value="{{ $inputs ['email']  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        件名
                    </th>
                    <td>
                        {{ $inputs ['title']  }}
                        <input type="hidden" name="title" value="{{ $inputs ['title']  }}">
                    </td>
                </tr>
                <tr>
                    <th>
                        詳細
                    </th>
                    <td>
                        <p>
                            {!! nl2br(e($inputs ['main'])) !!}
                        </p>
                        <input type="hidden" name="main" value='{{$inputs ["main"]}}'>
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
        </form>
    </div>
</div>
@endsection