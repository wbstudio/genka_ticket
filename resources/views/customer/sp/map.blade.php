@extends('customer.sp.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/customer/sp/map.css') }}">
<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyDRF6qxvkTy7jCRldOH6WNG6ooIYleixso&language=ja"></script> -->
@endsection

@section('content')


<div id="map"></div>
<div></div>


<script>
    // 現在地取得処理
    function initMap() {
      // Geolocation APIに対応している
      if (navigator.geolocation) {
        // 現在地を取得
        navigator.geolocation.getCurrentPosition(
          // 取得成功した場合
          function(position) {
            // 緯度・経度を変数に格納
            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            var markerData = [
              {
                  lat: 35.700430,
                  lng: 139.771720
              }, {
                  lat: 35.700366,
                  lng: 139.771713
              },{
                  lat: 35.832201743014195, 
                  lng: 139.5578176587671
              }
          ];
            // マップオプションを変数に格納
            var mapOptions = {
              zoom : 15,          // 拡大倍率
              center : mapLatLng,  // 緯度・経度
                       // マップオプション
              styles: [
                //全てのラベルを非表示
                {
                  featureType: 'all',
                  elementType: 'labels',
                  stylers: [
                    {visibility: 'off'},
                  ],
                },                
                {
                  featureType: 'poi',
                  elementType: 'labels.icon',
                  stylers: [
                    {visibility: 'inherit'},
                  ],
                },
              ],              
            };
            // マップオブジェクト作成
            var map = new google.maps.Map(
              document.getElementById("map"), // マップを表示する要素
              mapOptions,         // マップオプション
            );
            // marker.setMap(null);
            //　マップにマーカーを表示する
            var marker = new google.maps.Marker({
              map : map,             // 対象の地図オブジェクト
              position : mapLatLng   // 緯度・経度
            });

            // マーカー1の設置
            currentMarker = new google.maps.Marker({
              map : map,             // 対象の地図オブジェクト
              position : mapLatLng,   // 緯度・経度
              scaledSize : new google.maps.Size(19, 25)
            });
            // // マーカー2の設置
            shopMarker = new google.maps.Marker({
                position: markerData[0],
                map: map,
                icon: {
                  url: '../images/customer/icons/shop_marker.png',
                    scaledSize : new google.maps.Size(19, 25)
                }
            });
            // // マーカー3の設置
            shopMarker = new google.maps.Marker({
                position: markerData[1],
                map: map,
                icon: {
                  url: '../images/customer/icons/shop_marker.png',
                    scaledSize : new google.maps.Size(19, 25)
                }
            });
            // マーカー3の設置
            shopMarker = new google.maps.Marker({
                position: markerData[2],
                map: map,
                icon: {
                    url: '../images/customer/icons/shop_marker.png',
                    scaledSize : new google.maps.Size(19, 25)
                }
            });
          },
          // 取得失敗した場合
          function(error) {
            // エラーメッセージを表示
            switch(error.code) {
              case 1: // PERMISSION_DENIED
                alert("位置情報の利用が許可されていません");
                break;
              case 2: // POSITION_UNAVAILABLE
                alert("現在位置が取得できませんでした");
                break;
              case 3: // TIMEOUT
                alert("タイムアウトになりました");
                break;
              default:
                alert("その他のエラー(エラーコード:"+error.code+")");
                break;
            }
          }
        );
      // Geolocation APIに対応していない
      } else {
        alert("この端末では位置情報が取得できません");
      }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRF6qxvkTy7jCRldOH6WNG6ooIYleixso&callback=initMap"></script>

@endsection