<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public function getShopList()
    {

        $columnList = [
            "id",
            "email",
            "name",
            "category",
            "phone",
            "adress",
            "kind",
            "xaxis",
            "yaxis",            
            "status",
            "delete_flag",
            "created_at",
        ];

        $whereList = [
            ["delete_flag","=",0],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData;

        return $aList;
    }

    public function getShopData($shop_id)
    {

        $columnList = [
            "id",
            "email",
            "name",
            "category",
            "phone",
            "adress",
            "kind",
            "business_hour",
            "xaxis",
            "yaxis",            
            "status",
            "delete_flag",
            "created_at",
        ];

        $whereList = [
            ["delete_flag","=",0],
            ["id","=",$shop_id],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

}
