<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at'];

    protected $dates = [
        'create_at',
    ];

    /////////////////////////////////////////////////////////////////////////////
    // リレーションシップ設定
    /////////////////////////////////////////////////////////////////////////////
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }

    /**
     * 有効な継続課金を取得
     * 
     * @param int $customerId ユーザーID
     * @param bool $status 増減種別
     * 
     * @return array $tickets
     */
    static public function getTicketLogs($customerId, $status)
    {
        $query = self::from('tickets');

        $query->where([
            'customer_id' => $customerId,
            'status'      => $status,
            'delete_flag' => 0
        ]);

        return $query->get();
    }

}
