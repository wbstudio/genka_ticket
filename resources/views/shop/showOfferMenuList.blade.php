@extends('shop.include.layout')
@section('title', '')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop/menu.css') }}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('js/shop/menu.js') }}"></script>
@endsection

@section('content')
<div class="inner_content">

    <h2 class="title">原価ticketメニュー一覧</h2>
    <div class="menu_list">
        <div class="button_area">
            <a href="javascript:makeNewMenu({{$shopData['id']}});">+新規登録</a>
        </div>

        <div class="table_area">
        @if(!empty($shopServiceList))
        <table>
            <colgroup>
                <col style="width:10%;">
                <col style="width:40%;">
                <col style="width:20%;">
                <col style="width:20%;">
                <col style="width:10%;">
            </colgroup>
            <thead>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        名前
                    </td>
                    <td>
                        更新時間
                    </td>
                    <td>
                        登録時間
                    </td>
                    <td>
                        削除
                    </td>
                </tr>
            </thead>
            <tbody>
            @foreach($shopServiceList as $serviceData)
                <tr>
                    <td>
                        <a href="{{ route('shops.showOfferMenuEditForm', ['service_id' => $serviceData -> service_id]) }}">
                            {{$serviceData -> service_id}}
                        </a>
                    </td>
                    <td class="dt_title">
                        <a href="{{ route('shops.showOfferMenuEditForm', ['service_id' => $serviceData -> service_id]) }}">
                            {{$serviceData -> service_name}}
                        </a>
                    </td>
                    <td>
                        {{$serviceData -> updated_at -> format('Y/m/d H:i')}}
                    </td>
                    <td>
                        {{$serviceData -> created_at -> format('Y/m/d H:i')}}
                    </td>
                    <td>
                        <a href="{{route('shops.deleteMenu', ['service_id' => $serviceData -> service_id,'shop_id' => $shopData['id']])}}" class="delete">削除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>           
        </table>
        @endif
        </div>
        <div class="memo">
            <p>
                表示できる原価ticket用メニューは3つまでとしております。<br>
                また、ticket利用の際のトラブル防止のため以下のことはできません。<br>
                よろしくお願いします。
            </p>
            <ul>
                <li>同一メニューの23時間以内の編集</li>
                <li>3つ以上のメニュー登録</li>
                <li>その他ticket利用の混乱を招くような編集</li>
            </ul>
        </div>
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



