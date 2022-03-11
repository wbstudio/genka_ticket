@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<form action="{{ route('shops.confirmRegistEmail') }}" method="post">
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
                <input type="text" name="email" value="{{ old('email') }}">
            </td>
        </tr>
        <tr>
            <th>
                パスワード<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="password" name="password" value="">
            </td>
        </tr>
        <tr>
            <th>
                確認用<span class="asterisk">＊</span>
            </th>
            <td>
                <input type="password" name="confirm_password" value="">
            </td>
        </tr>
    </tbody>
</table>
@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
<button type="submit" name="action" value="submit">
    確認画面へ
</button>
</form>
@endsection