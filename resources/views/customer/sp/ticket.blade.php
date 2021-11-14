@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/ticket.css') }}">
@endsection

@section('content')
<div>

</div>
<script src="{{ asset('js/customer/sp/ticket.js') }}"></script>
@endsection