<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;

class EntranceController extends Controller
{
    //
    public function index () 
    {
        $commonController = new CommonController;
        $displayType = $commonController->selectBrowser();
        return view('Entrance.'. $displayType .'.index');
    }

    public function showRegistForm () 
    {
        var_dump("EntranceController--showRegistForm");
        // return view('index');
    }


}
