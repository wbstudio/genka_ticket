<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;

class EntranceController extends Controller
{
    //
    public function index () 
    {
        CommonController::selectBrowser();
        return view('Entrance.'. USER_AGENT .'.index');
    }

    public function showRegistForm () 
    {
        var_dump("EntranceController--showRegistForm");
        // return view('index');
    }


}
