<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Consts\TicketConsts;

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
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }


    /**
     * 有効な継続課金を取得
     * 
     * @param int $customerId ユーザーID
     * 
     * @return array $tickets
     */
    static public function getUsageHistory($customerId)
    {
        $query = self::from('tickets');

        $query->where([
            'customer_id' => $customerId,
            'status'      => TicketConsts::TICKET_STATUS['USED'],
            'delete_flag' => 0
        ]);

        return $query->get();
    }

}
