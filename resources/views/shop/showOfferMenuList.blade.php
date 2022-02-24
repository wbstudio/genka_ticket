@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/home.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/shop/menu.js') }}"></script>
@endsection

@section('content')
<div>
    <a href="javascript:makeNewMenu({{$shopData['id']}});">新規登録</a>

    <div>
    @if(!empty($shopServiceList))
        @foreach($shopServiceList as $serviceData)
            {{$serviceData -> service_id}}<br>
        @endforeach
    @endif
    </div>
</div>

<script type="text/javascript">
    //
    function makeNewMenu(shopId){
        $.ajax({
          type: "get", //HTTP通信の種類
          url: "/ajax/shop/checkMakeNewMenu/" + shopId,
          dataType: "json",
        }).done((response) => {
            const baseTime = new Date();
            baseTime.setHours(baseTime.getHours() - 22);
            var baseGetTime = baseTime.getTime();
            var baseMathTime = Math.floor( baseGetTime / 1000 );
            var newMenuRight = true;
            var cntDelZero = 0;
            var cntDelOne = 0;

            $.each(response,function(idx,elem){
                var updateTime = new Date(elem.updated_at);
                var updateGetTime = updateTime.getTime() ;
                var updateMathTime = Math.floor( updateGetTime / 1000 );

                if(elem.delete_flag == 0){
                    cntDelZero++;
                }else if(elem.delete_flag == 1 && baseMathTime < updateMathTime){
                    cntDelOne++;
                }

            })

            if(cntDelZero > 2 || cntDelOne > 0){
                newMenuRight = false;
            }

            if(newMenuRight){
            	window.location.href = "/shops/admin/offerMenu/regist";
            }else{
                alert("「23時間以内に削除があった場合」もしくは「公開件数の上限に達している場合」新規追加はできませんのでご了承ください。");
                return false;
            }


        }).fail((error) => {
            console.log(error.parsererror);
        });
    }
</script>
@endsection



