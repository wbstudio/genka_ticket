@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/map.css') }}">
<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDRF6qxvkTy7jCRldOH6WNG6ooIYleixso&language=ja"></script> -->
@endsection

@section('content')


<div id="map"></div>
<div id="subject">
</div>


<script src="{{ asset('js/customer/sp/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRF6qxvkTy7jCRldOH6WNG6ooIYleixso&callback=initMap"></script>

@endsection