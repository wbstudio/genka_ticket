<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Customer\Shop;

class ShopController extends Controller
{
    //
    public function selectShopPushMaekerId($shop_id) {

        $mdShop= new Shop();
        $shopDate = $mdShop->getShopInfoById($shop_id);


        return response()->json($shopDate);

    }

}
