@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/admin.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticket----運営</h2>
    <div class="fix_text_area">
        <table>
            <colgroup> 
                <col style='width: 25%;'>
                <col style='width: 75%;'>
            </colgroup>
            <tbody>
                <tr>
                    <td class="name">
                        店舗名
                    </td>
                    <td class="dt_data">
                        oooooooooooooooooooooooooooooooo
                    </td>
                </tr>
                <tr>
                    <td class="name">
                        店舗名
                    </td>
                    <td class="dt_data">
                        oooooooooooooooooooooooooooooooo
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection