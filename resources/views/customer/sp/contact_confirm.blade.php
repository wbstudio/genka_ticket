@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div>
    <div class="w-full mt-6 text-center text-gray-700 text-2xl font-bold">内容確認</div>
    <form method="POST" action="{{ route('customer.contact.send') }}">
        @csrf
        <table class="w-full mt-2">
            <tbody>
                <tr>
                    <td class="pt-4">
                        お名前
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                        {{ $inputs['name'] }}
                    </td>
                </tr>
                <tr>
                    <td class="pt-4">
                        返信用アドレス
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                        {{ $inputs['email'] }}
                    </td>
                </tr>
                <tr>
                    <td class="pt-4">
                        お問い合わせ内容
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                        {!! nl2br(e($inputs['main'])) !!}
                    </td>
                </tr>
                <tr>
                    <td class="text-center pt-6">
                    <button type="submit" name="action" value="back" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">修正する</button>
                    <button type="submit" name="action" value="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">送信する</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="name" value="{{ $inputs['name'] }}">
        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        <input type="hidden" name="main" value="{{ $inputs['main'] }}">
    </form>
</div>
@endsection