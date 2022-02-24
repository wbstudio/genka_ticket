<?php

namespace App\Http\Controllers\Shops\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Shop\Shop;

class ShopController extends Controller
{
    //
    public function checkShopMenu($shop_id) {

        $mdShop= new Shop();
        $shopDate = $mdShop->getCheckShopDataByShopId($shop_id);

        return response()->json($shopDate);

    }
}
