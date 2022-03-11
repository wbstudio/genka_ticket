<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function getServiceInfoById($shopId,$service_id)
    {
        $columnList = [
            "id as service_id",
            "shop_id",
            "name",
            "detail",
            "created_at",
            "updated_at",
        ];

        $whereList = [
            ["id","=",$service_id],
            ["shop_id","=",$shopId],
            ["delete_flag","=",0],
        ];

        $dispData =$this::from("services")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }


}
