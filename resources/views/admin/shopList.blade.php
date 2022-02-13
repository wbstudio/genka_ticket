@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div>
    @foreach($adminShopList as $shopData)
        @if($shopData -> status < 2)
            <a href="{{ route('admin.showShopForm', ['shop_id' => $shopData->id]) }}">
                {{$shopData -> id}}<br>
            </a>
        @else
            <a href="{{ route('admin.showEditShopForm', ['shop_id' => $shopData->id]) }}">
                {{$shopData -> id}}<br>
            </a>
        @endif
    @endforeach
</div>
@endsection