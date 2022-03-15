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

    public function getShopMenuInfoById($id)
    {
        $columnList = [
            "shops.id",
            "shops.name",
            "services.id as service_id",
            "services.name as service_name",
            "services.created_at",
            "services.updated_at",
        ];

        $whereList = [
            ["shops.id","=",$id],
        ];

        $joinOnList = [
            ["shops.id","=","services.shop_id"],
            ["services.delete_flag","=", 0],
        ];

        $dispData =$this::from("shops")
                    ->where($whereList)
                    ->join('services', function ($join) {
                        $join->on('shops.id', '=', 'services.shop_id')
                            ->where('services.delete_flag', '=', 0);
                    })
                    ->get($columnList);

        $aList = $dispData;

        return $aList;
    }

    public function getShopTicketInfoById($id,$startTime,$endTime,$currentPage,$perPage)
    {
        $offset = $currentPage * $perPage;

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
                    ->orderBy('created_at', 'desc')
                    ->offset($offset)
                    ->limit($perPage)
                    ->get($columnList);

        $aList["dispData"] = $dispData;


        $count  =$this::from("tickets")
                    ->where($whereList)
                    ->count();

        $aList["count"] = $count;

        return $aList;
    }

    public function getCheckShopDataByShopId($shop_id)
    {

        $columnList = [
            'id as service_id',
            'delete_flag',
            'updated_at',
            'created_at',
        ];

        $whereList = [
            ["shop_id","=",$shop_id],
            ["delete_flag","=",0],
        ];

        $orWhereList = [
            ["shop_id","=",$shop_id],
            ["delete_flag","=",1],
            ["updated_at",">",date('Y-m-d H:i:s', time()-(22*60*60))],
        ];

        $dispData =$this::from("services")
                    ->where($whereList)
                    ->orWhere($orWhereList)
                    ->get($columnList);

        $aList = $dispData;

        return $aList;
    }


}
