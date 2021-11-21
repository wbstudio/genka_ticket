@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/ticket.css') }}">
@endsection

@section('content')
<div class="title">
    チケット足りない
</div>
<div>
    <a>購入ページへ</a>
</div>
@endsection