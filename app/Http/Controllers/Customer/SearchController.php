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
        $category  = $request -> category;
        $station_get  = $request -> station;
        $line_get  = $request -> line;
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
        define("PAGE_LIMIT",1);
        $useData["offset"] = 0;
        if(isset($page)){
            $useData["offset"] = PAGE_LIMIT * ($page - 1);
        }else{
            $page = 1;
        }
        //カテゴリーパラメーター
        $categoryArray = null;
        if($method == "POST"){
            $useData["category"] = $category_post;
            $categoryArray = $category_post;
        }else{
            if(isset($category)){
                $useData["category"] = explode(",",$category);
                $categoryArray = explode(",",$category);
            }
        }
        //位置情報パラメーター
        $url  = public_path() . '/json/stations.json';
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $arr  = json_decode($json,true);
        $useData["station"] = null;
        $useData["line"] = null;

        if($method == "POST"){
            if(isset($station)){
                $useData["lat"] = $arr[$line][$station]["lat"];
                $useData["lon"] = $arr[$line][$station]["lon"];
                $useData["station"] = $station;
                $useData["line"] = $line;
            }else{
                //station_cdがなかったら現在地
                $useData["lat"] = $current_lat;
                $useData["lon"] = $current_lon;
            }
        }else{
            $useData["lat"] = $lat;
            $useData["lon"] = $lon;
            if(isset($station_get)){
                $useData["station"] = $station_get;
                $useData["line"] = $line_get;
            }
        }

        $stationArray = null;
        if(isset($useData["station"])){
            $stationArray["station_cd"] = $arr[$line][$useData["station"]]["station_cd"];
            $stationArray["pref_cd"] = $arr[$line][$useData["station"]]["pref_cd"];
            $stationArray["line_cd"] = $arr[$line][$useData["station"]]["line_cd"];
        }

        //whereとget
        $baseUrl = url()->current();
        $baseUrl = $baseUrl ."?lat=". $useData["lat"] ."&lon=".$useData["lon"]."&line=". $useData["line"]."&station=". $useData["station"];

        $whereCategory = "";
        if(isset($useData["category"]) && $useData["category"][0] != ""){
            if(is_array($useData["category"])){
                $whereCategory = "AND category IN (". join(",",$useData["category"]).")";
                $baseUrl = $baseUrl ."&category=".join(",",$useData["category"]);
            }else if($useData["category"] != ""){
                $whereCategory = "AND category = ".$useData["category"]." ";
                $baseUrl = $baseUrl ."&category=".$useData["category"];
            }
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

        $sqlForCnt = "SELECT 
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
                                DISTANCE < 21;";

        $allShopDataList = DB::select($sqlForCnt);
        $allDataCount = count($allShopDataList);

        $data = CommonController::purepagenator($allDataCount,$page,PAGE_LIMIT);

        $dispData = [
            'pageTitle' => $page_title,
            'pageType' => $page_type,
            'pagenator' => $data ->link,
            'page' => $page,
            'shops' => $shopDataList,
            'useData' => $useData,
            'baseUrl' => $baseUrl,
            'categoryArray' => $categoryArray,
            'stationArray' => $stationArray,
        ];


        return view('customer.'. USER_AGENT .'.search', $dispData);

    }
}
