@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/search.css') }}">
<script src="{{ asset('js/customer/sp/search.js') }}"></script>
@endsection

@section('content')
<form method="POST" action="{{ route('customer.search.post') }}">
    @csrf
    <div class="section s_01">
        <div class="accordion_one">
            <div class="accordion_header">
                駅を選択
                <div class="go_button down"></div>
            </div>
            <div class="accordion_inner">
                <div class="station_toggle">
                    <select id="prefecture" name="prefecture">
                        <option value="">都道府県を選択してください</option>
                        @foreach(Config::get('prefectures') as $key => $prefecture)
                        <option value="{{$key}}">{{$prefecture["name"]}}</option>
                        @endforeach
                    </select>
                    <select id="line" name="line">
                        <option value="">路線を選択してください</option>
                    </select>
                    <select id="station" name="station">
                        <option value="">駅を選択してください</option>
                    </select>
                    <div class="caution_area">
                        <p>※「都道府県」「路線」のみでの絞り込みはできません。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section s_01">
        <div class="accordion_one">
            <div class="accordion_header">
                カテゴリーを選択
                <div class="go_button down"></div>
            </div>
            <div class="accordion_inner">
                <div class="category_toggle">
                    @foreach(Config::get('categories') as $key => $category)
                    <div class="category_mass">
                        <input id="category_{{$key}}" type="checkbox" value="{{$key}}" name="category[]" @if(isset($categoryArray) && (in_array($key,$categoryArray))) checked @endif>
                        <label for="category_{{$key}}">{{$category["name"]}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="btn_area">
        <button>店舗を検索</button>
    </div>

    <input type="hidden" class="station_prefecture" name="station_prefecture" value="{{$stationArray['pref_cd']}}">
    <input type="hidden" class="station_line" name="station_line" value="{{$stationArray['line_cd']}}">
    <input type="hidden" class="station_cd" name="station_cd" value="{{$stationArray['station_cd']}}">

    <input type="hidden" class="current_lat" name="current_lat" value="">
    <input type="hidden" class="current_lon" name="current_lon" value="">
</form>



<!-- List -->
@if(isset($shops) && is_countable($shops))
<div>
    @foreach($shops as $shop)
    <div>
        {{$shop->name}}<br>{{$shop->DISTANCE}}
    </div>
    @endforeach
</div>
@else
<div>記事がないです</div>
@endif

<!-- ページャー -->
<div id="pagenator">
	@isset($pagenator -> firstPageNum)
	<a href="{{$baseUrl}}&page={{$pagenator -> firstPageNum}}">最初</a>
	@endisset
	@isset($pagenator -> prePageNum)
	<a href="{{$baseUrl}}&page={{$pagenator -> prePageNum}}">前へ</a>
	@endisset
	@isset($pagenator -> firstPageNum)
	...
	@endisset
	@isset($pagenator -> linkNum)
		@foreach($pagenator -> linkNum as $key => $Num)
		@if($page == $Num)
		<span style="background:#FF0;">{{$Num}}</span>
		@else
		<a href="{{$baseUrl}}&page={{$Num}}">{{$Num}}</a>
		@endif
		@endforeach
	@endisset
	@isset($pagenator -> lastPageNum)
	...
	@endisset
	@isset($pagenator -> nextPageNum)
	<a href="{{$baseUrl}}&page={{$pagenator -> nextPageNum}}">次へ</a>
	@endisset
	@isset($pagenator -> lastPageNum)
	<a href="{{$baseUrl}}&page={{$pagenator -> lastPageNum}}">最後</a>
	@endisset
</div>


@endsection