<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function selectBrowser() {

        $user_agent = Cookie::get('ua_coolie');
        if(!(isset($user_agent) && $user_agent != "")){
            $ua = $_SERVER['HTTP_USER_AGENT'];

            if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false)) {
                $user_agent = "sp";
            } elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) {
                $user_agent = "pc";      
            } else {
                $user_agent = "pc";      
            } 

            Cookie::queue("ua_coolie", $user_agent, 24*60);
        }
        //一旦開発はSPのみなので
        $user_agent = "sp";
        
        define("USER_AGENT",$user_agent);

        return $user_agent;
    }

    /**
    *$dArray=>データ
    *$c_page=>現在のページ
    *$per_page=>ページ内の表示数
    *で動くページネーター
    */
    public static function purepagenator($all_cnt,$c_page,$per_page){

        $link = new \stdClass();
        $pagenator =  new \stdClass(); 
        $totalData = $all_cnt;
        $totalPageCount = ceil($totalData/$per_page);
        $linkArray = array();
        if($c_page > 1){
            $link->prePageNum = $c_page - 1;
        }
        if($c_page < $totalPageCount){
            $link ->nextPageNum = $c_page + 1;
        }
        if($c_page > 4){
            $link ->firstPageNum   = 1;
        }
        if($c_page < $totalPageCount - 3){
            $link ->lastPageNum    = $totalPageCount;
        }
        $start = 1;
        $end = $totalPageCount;
        if($c_page > 3){
            $start = $c_page - 3; 
        }
        if($c_page < $totalPageCount - 3){
            $end = $c_page + 3; 
        }
        for($i = $start;$i < $end + 1;$i++){
            $linkArray[$i-$start] = $i;
        }

        $link ->linkNum = $linkArray;
        $pagenator ->link = $link;
        return $pagenator;
    }


}
