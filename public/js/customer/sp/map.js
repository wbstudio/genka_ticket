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

          var markerData = new Array();
          //toDo--JSON or Ajax を決めてプログラムを書く
          //Jsonならbatch処理
          //Ajaxなら店舗を撮る範囲を考える
          markerData.push (
            {
                id:2,
                lat: 35.700430,
                lng: 139.771720
            });
            markerData.push (
            {
              id:4,
                lat: 35.700366,
                lng: 139.771713
            });
            markerData.push (
            {
              id:5,
                lat: 35.832201743014195, 
                lng: 139.5578176587671
            });
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

          for (i = 0; i < markerData.length; i++) {
            var markers = new google.maps.Marker({
              position: new google.maps.LatLng(markerData[i].lat, markerData[i].lng),
              map: map,
              icon: {
                url: '../images/customer/icons/shop_marker.png',
                  scaledSize : new google.maps.Size(19, 25)
              }
            });
            markerEvent(i); 
          }
          // マーカーにクリックイベントを追加
          function markerEvent(i) {
            google.maps.event.addListener(markers, 'click', function(){
              $.ajax({
                type: "get", //HTTP通信の種類
                url: "/ajax/shop/" + markerData[i].id,
                dataType: "json",
              })
              .done((res) => {
                console.log(res);
                // var html = '<div><a href="">店名'+ res.name +'</a></div>';
                var shopPath = "shop/" + res.id;
                var imgPath = "../images/customer/sp/no_image.png";
                var shopName = "テスト店舗名テスト店舗名テスト店舗名テスト店舗名";
                var shopTime = "00:00~00:00";
                var shopCate = "カテゴリーテスト";
                var shopMessage = "メッセージテストメッセージテストメッセージテストメッセージテストメッセージテストメッセージテストメッセージテスト";

                var html = '<div class="shop_detail">'
                         + '<a href="'+shopPath+'">'
                         + '<div class="shop_detail_inner">'
                         + '<div class="inner_upside">'
                         + '<img src="'+imgPath+'">'
                         + '<table>'
                         + '<tr>'
                         + '<td colspan="2" class="shop_name">'
                         + shopName
                         + '</td>'
                         + '</tr>'
                         + '<tr class="shop_business_hour">'
                         + '<th>'
                         + '営業時間'
                         + '</th>'
                         + '<td>'
                         + shopTime
                         + '</td>'
                         + '</tr>'
                         + '<tr class="shop_category">'
                         + '<th>'
                         + 'カテゴリー'
                         + '</th>'
                         + '<td>'
                         + shopCate
                         + '</td>'
                         + '</tr>'
                         + '</table>'
                         + '</div>'
                         + '<div class="inner_downside">'
                         + '<p>'
                         + shopMessage
                         + '</p>'
                         + '</div>'
                         + '</div>'
                         + '</a>'
                         + '</div>'
        
                $('#subject').html(html);
              })
              //通信が失敗したとき
              .fail((error) => {
                console.log(error.statusText);
              });
            });
          }
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