$(function(){
    //humbergerMenu
    $('.menu_icon').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });
    
    
    //現在地取得--searchに現在地を渡して現在地から近い店舗を表示
    navigator.geolocation.getCurrentPosition(success,fail);

    function success(pos){
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        $(".current_lat").val(lat); 
        $(".current_lon").val(lng);
        var linkUrl = $("a.search_link").attr('href');
        linkUrl = linkUrl + "?lat=" + lat + "&lon=" + lng;
        $("a.search_link").attr("href", linkUrl);
    }
    
    function fail(pos){
        alert('位置情報の取得に失敗しました。エラーコード：');
    }

});