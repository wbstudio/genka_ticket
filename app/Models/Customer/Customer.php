<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    //loginした後にidをsessionに格納したい
    //TODO--LINEに仕様変更した際に引数などの変更お願いします！
    public function getCustomerInfoWhenLogin($email)
    {
        $columnList = [
            "id",
            "email",
        ];

        $whereList = [
            ["email","=",$email],
        ];

        $dispData =$this::from("customers")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

    public function getCustomerInfoById($customerId)
    {
        $columnList = [
            "id",
            "name",
            "email",
            "ticket",
        ];

        $whereList = [
            ["id","=",$customerId],
        ];

        $dispData =$this::from("customers")
                    ->where($whereList)
                    ->get($columnList);

        $aList = $dispData[0];

        return $aList;
    }

    
}
