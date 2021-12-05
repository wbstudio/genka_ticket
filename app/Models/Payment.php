<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at'];

    protected $dates = [
        'create_at',
    ];

    /**
     * 有効な課金を取得
     * 
     * @param int $customerId ユーザーID
     * 
     * @return array $payments
     */
    static public function getPaymentLogs($customerId)
    {
        $query = self::from('payments');

        $query->where([
            'customer_id' => $customerId,
            'delete_flag' => 0
        ]);

        return $query->get();
    }
}
