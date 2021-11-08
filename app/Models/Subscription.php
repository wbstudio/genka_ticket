<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * 有効な継続課金を取得
     * 
     * @param int $customerId ユーザーID
     * @param bool $isOnlyValidSubscription 有効な継続課金のみ
     * 
     * @return array $subscriptions
     */
    static public function getSubscriptions($customerId, $isOnlyValidSubscription = true)
    {
        $query = self::from('subscriptions');
        
        $query->where([
            'customer_id' => $customerId,
            'delete_flag' => 0
        ]);

        // 有効な継続課金のみの場合
        if ($isOnlyValidSubscription) {
            $dateObj = new \Datetime();
            $today = $dateObj->format('Y-m-d');

            $query->where(function($query) use($today){
                $query->where('end_on', 'IS', null)
                      ->orWhere('end_on', '<=', $today);
            });
        }

        return $query->get();
    }
    
}
