@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<form action="{{ route('shops.completeRegistEmail') }}" method="post">
@csrf
<table>
    <thead>
        <tr>
            <th>

            </th>
            <td>

            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                {{ $inputs['email']  }}
                <input type="hidden" name="email" value="{{ $inputs['email']  }}">
            </td>
        </tr>
        <tr>
            <th>
                パスワード<span class="asterisk">＊</span>
            </th>
            <td>
                {{$inputs['password_display']}}
                <input type="hidden" name="password" value="{{$inputs['password']}}">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    登録する
</button>
<button type="submit" name="action" value="back">
    修正する
</button>
</form>
@endsection