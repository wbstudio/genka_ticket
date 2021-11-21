@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/ticket.css') }}">
@endsection

@section('content')
<div class="title">
    QR読み取り完了
</div>
<div class="qrread_area">
</div>
@endsection