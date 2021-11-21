@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/ticket.css') }}">
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.1.1/dist/jsQR.min.js" integrity="sha384-i4Tuh5Z0ns/3M0289mSougur8irvedWPBlwOcJ7ob5AK/rvN5tjkwzu7P1k1dThG" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="title">
    QR読み取り
</div>
<div class="qrread_area">
    <div id="pane-webcam">
        <video name="video" autoplay class="qr_video"></video>
        <canvas name="canvas" class="qr_canvas"></canvas>
    </div>
</div>
@include('customer.sp.include.ticket_confirm_modal')
<script src="{{ asset('js/customer/sp/ticket.js') }}"></script>
<input type="hidden" id="customer_id" value="{{$customerData['customer_id']}}">
@endsection