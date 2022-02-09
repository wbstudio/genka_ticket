@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div>
<a href="{{route('admin.shopList')}}">店舗管理一覧</a>
<a href="{{route('admin.customerList')}}">ユーザー管理一覧</a>
<a href="{{route('admin.billList')}}">入金管理一覧</a>
<a href="{{route('admin.ticketList')}}">ticket利用管理一覧</a>
<a href="{{route('admin.contactList')}}">問い合わせ管理一覧</a>
</div>
@endsection