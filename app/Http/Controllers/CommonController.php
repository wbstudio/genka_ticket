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
}
