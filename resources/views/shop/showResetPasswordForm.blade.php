@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<form action="{{ route('shops.sendResetPasswordMail') }}" method="post">
@csrf
<table>
    <tbody>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                <input type="text" name="email" value="">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    送信する
</button>
</form>
@endsection