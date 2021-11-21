<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    //20件
    //station_cdのvalがなければcurrent_lat,current_lon
    //あればstation_cdのvalからlatとlonをとる
    /**
     * lat → xAxis
     * lon → yAxis
    */
    public function index(Request $request) {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        $page_title = "原チケ-Search";
        $page_type = "SEARCH";
        $method = $request->method();
        //GETデータ
        $lat   = $request -> lat;
        $lon   = $request -> lon;
        $page  = $request -> page;
        $category  = $request -> page;
        //POSTデータ
        $line = $request->input('line');
        $station = $request->input('station');
        $current_lat = $request->input('current_lat');
        $current_lon = $request->input('current_lon');
        $category_post = $request->input('category');

        /**
         * 1.初期表示
         * 2.POST
         * 3.ページャー
        */
        $useData = array();
        //ページパラメーター
        define("PAGE_LIMIT",20);
        $useData["offset"] = 0;
        if(isset($page)){
            $useData["offset"] = PAGE_LIMIT * ($page - 1);
        }
        //カテゴリーパラメーター
        if($method == "POST"){
            $useData["category"] = $category_post;
        }else{
            $useData["category"] = $category;
        }
        //位置情報パラメーター
        if($method == "POST"){
            if(isset($station)){
                $url = public_path() . '/json/stations.json';
                $json = file_get_contents($url);
                $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
                $arr = json_decode($json,true);
                $useData["lat"] = $arr[$line][$station]["lat"];
                $useData["lon"] = $arr[$line][$station]["lon"];
            }else{
                //station_cdがなかったら現在地
                $useData["lat"] = $current_lat;
                $useData["lon"] = $current_lon;
            }
        }else{
            $useData["lat"] = $lat;
            $useData["lon"] = $lon;
        }
        $whereCategory = "";
        if(isset($useData["category"])){
            $whereCategory = "AND category IN (". join(",",$useData["category"]).")";
        }

        $sql = "SELECT 
                    name
                    ,category
                    ,business_hour
                    , ( 
                        6371 * ACOS( 
                        COS(RADIANS(". $useData["lat"]. ")) * COS(RADIANS(xaxis)) * COS(RADIANS(yaxis) - RADIANS(". $useData["lon"]. "))
                        + SIN(RADIANS(". $useData["lat"]. ")) * SIN(RADIANS(xaxis))
                        )
                    ) as DISTANCE 
                FROM 
                    shops
                WHERE
                    delete_flag = 0
                    ". $whereCategory .
               " HAVING  
                     DISTANCE < 21
                ORDER BY 
                    DISTANCE 
                LIMIT ". PAGE_LIMIT .
               " OFFSET ".$useData["offset"].";";

        $shopDataList = DB::select($sql);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
        ];

        return view('customer.'. USER_AGENT .'.search', $dispData);

    }
}
