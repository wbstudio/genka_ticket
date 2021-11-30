@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<link rel="stylesheet" href="{{ asset('css/customer/sp/ticket.css') }}">
<script src="https://cdn.jsdelivr.net/npm/qrcode@latest/build/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@latest/dist/jsQR.min.js"></script>
@endsection

@section('content')
<video id="video" width="320" height="480" autoplay></video>
<textarea id="result" readonly></textarea>
<canvas id="canvas" width="240" height="240"></canvas>
<textarea id="data" style="visibility: hidden;"></textarea>
<div>
    <p>

    </p>
</div>

@include('customer.sp.include.ticket_confirm_modal')
<script src="{{ asset('js/customer/sp/ticket.js') }}"></script>
<input type="hidden" id="customer_id" value="{{$customerData->id}}">
<input type="hidden" id="ticket_cnt" value="{{$customerData->ticket}}">
@endsection