@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div>
    <div class="w-full mt-6 text-center text-gray-700 text-2xl font-bold">お問い合わせ</div>
    <form method="POST" action="{{ route('customer.contact.confirm') }}">
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
                        <input class="w-full py-1 text-gray-700 border border-1 rounded border-gray-600" type="text" name="name" value="@if(!empty(old('name')) && old('name') == 0) {{ old('name') }} @else {{$customerData->name}} @endif">
                    </td>
                </tr>
                <tr>
                    <td class="pt-4">
                        返信用アドレス
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                        <input class="w-full py-1 text-gray-700 border border-1 rounded border-gray-600" type="email" name="email" value="@if(!empty(old('email')) && old('email') == 0) {{ old('email') }} @else {{$customerData->email}} @endif" required>
                    </td>
                </tr>
                <tr>
                    <td class="pt-4">
                        お問い合わせ内容
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                        <textarea class="w-full h-48 py-1 text-gray-700 border border-1 rounded border-gray-600" required name="main">
                            {{ old('main') }}
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td class="text-center pt-6">
                        <button type="submit" class="p-2 pl-5 pr-5 bg-transparent border-2 border-red-500 text-red-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">確認する</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection