<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function getShopInfoByEmail($email)
    {
        $columnList = [
            "id",
            "email",
        ];

        $whereList = [
            ["email","=",$email],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

    public function getShopInfoById($id)
    {
        $columnList = [
            "id",
            "name",
            "email",
            "kind",
            "category",
            "adress",
            "phone",
            "business_hour",
            "xaxis",
            "yaxis",
            "status",
            "delete_flag",
            "created_at",
            "updated_at",
        ];

        $whereList = [
            ["id","=",$id],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

    public function getShopTicketInfoById($id,$startTime,$endTime)
    {

        $columnList = [
            "id",
            "shop_id",
            "service_id",
            "customer_id",
            "count",
            "status",
            "delete_flag",
            "created_at",
        ];

        $whereList = [
            ["shop_id","=",$id],
            ["delete_flag","=",0],
            ["status","=",0],
            ["created_at",">=",$startTime],
            ["created_at","<",$endTime],
        ];

        $dispData =$this::from("tickets")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData;

        return $aList;
    }


}
