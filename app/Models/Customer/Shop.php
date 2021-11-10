<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function getShopInfoById($shopId)
    {
        $columnList = [
            "id",
            "name",
            "email",
            "category",
            "kind",
            "adress",
            "business_hour",
            "phone",
        ];

        $whereList = [
            ["id","=",$shopId],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

}
