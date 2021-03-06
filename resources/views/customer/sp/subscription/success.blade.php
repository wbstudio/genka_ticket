@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="my-10">
    <h2 class="text-center">定期チケット購入完了</h2>
</div>
<div class="text-center">
    <a href="{{ route('customer.bill') }}" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">戻る</a>
</div>
@endsection