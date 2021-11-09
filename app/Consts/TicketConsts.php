<?php

namespace App\Consts;

/**
 * チケット周りで使う定数
 */
class TicketConsts
{
    public const PRICE_TAX_RATE = 0.1;

    public const SINGLE_TICKET_INFO = [
        'name' => '追加チケット',
        'descriptions' => [
            '1枚300円分の原価メニューが楽しめるチケットを1枚配布します。'
        ],
        'cautions' => [
            '使用期限は発行から6ヶ月です。',
        ],
        'unit_price' => 300,
    ];
    public const SINGLE_TICKET_PRICE = 300;

    public const SUBSCRIPTION_TICKET_INFO = [
        'name' => '定期チケット',
        'descriptions' => [
            '1枚300円分の原価メニューが楽しめるチケットを1ヶ月10枚配布します。'
        ],
        'cautions' => [
            '使用期限は発行から6ヶ月です。',
            '購入日から起算して30日後の更新日が設定されます。',
            '30日後の更新日までに「解約手続き」をしない場合は、自動的に契約が更新されます。',
        ],
        'quantity' => 10,
    ];
    public const SUBSCRIPTION_TICKET_PRICE = 3000;

    public const TICKET_PAYMENT_KIND = [
        'SUBSCRIPTION' => 0, // 継続課金
        'SINGLE'       => 1, // 追加購入
    ];

    public const TICKET_STATUS = [
        'USED'         => 0, // 利用
        'SUBSCRIPTION' => 1, // 継続課金
        'EXPIRED'      => 2, // 期限切れ
        'SINGLE'       => 3, // 追加購入
    ];

}