$(function(){

    //アコーディオン
    $('.s_01 .accordion_one .accordion_header').click(function(){
        $(this).next('.accordion_inner').slideToggle();
        $(this).toggleClass("open");
    });

    //現在地取得
    navigator.geolocation.getCurrentPosition(success,fail);

    var station_cd = $(".station_cd").val();
    var station_prefecture = $(".station_prefecture").val();
    var station_line = $(".station_line").val();
    if(station_cd.length > 0){
        setSelectStation(station_cd,station_prefecture,station_line);
    }

    //select
    $('#prefecture').change(function() {
        var prefectureVal = $(this).val();
        makeOptions("line",prefectureVal);
    });

    //select
    $('#line').change(function() {
        var lineVal = $(this).val();
        makeOptions("station",lineVal);
    });

    //select
    $('#station').change(function() {
        var stationVal = $(this).val();
        $(".station_cd").val(stationVal);
    });

    function makeOptions(selectId,selectVal){
        console.log("aaaaaaaa");
        $.getJSON("../json/" + selectId + "s.json" , function(jsonData) {
            var data = jsonData;
            $select = $('#'+ selectId );
            var optionsData;

            optionsData = data[selectVal];
            $('#'+ selectId + " option").not(':first').remove();

            if(selectId == "line"){
                $.each(optionsData, function (key, value) {
                    $option = $('<option>')
                        .val(key)
                        .text(value);
                    $select.append($option);
                });                
            }else if(selectId == "station"){
                $.each(optionsData, function (key,value) {
                    $option = $('<option>')
                        .val(value.station_cd)
                        .text(value.station_name);
                    $select.append($option);
                });                
            }
        });
    }

    function success(pos){
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        $(".current_lat").val(lat); 
        $(".current_lon").val(lng); 
    }
    
    function fail(pos){
        alert('位置情報の取得に失敗しました。エラーコード：');
    }
    
    function setSelectStation(station_cd,station_prefecture,station_line){
        makeOptions("line",station_prefecture);
        makeOptions("station",station_line);
        setTimeout(function(){
            $("select#prefecture").val(station_prefecture);
            $("select#line").val(station_line);
            $("select#station").val(station_cd);
        },200);
    }
    
    

});