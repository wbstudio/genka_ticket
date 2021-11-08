<?php

namespace App\Consts;

/**
 * 商品周りで使う定数
 */
class ProductConsts
{
    public const PRICE_TAX_RATE = 0.1;

    public const SINGLE_PRODUCT = [
        'name' => '追加チケット',
        'descriptions' => [
            '1枚300円分の原価メニューが楽しめるチケットを1枚配布します。'
        ],
        'cautions' => [
            '使用期限は発行から6ヶ月です。',
        ],
        'unit_price' => 300,
    ];

    public const SUBSCRIPTION_PRODUCT = [
        'name' => '定期チケット',
        'descriptions' => [
            '1枚300円分の原価メニューが楽しめるチケットを1ヶ月10枚配布します。'
        ],
        'cautions' => [
            '使用期限は発行から6ヶ月です。',
            '購入日から起算して30日後の更新日が設定されます。',
            '30日後の更新日までに「解約手続き」をしない場合は、自動的に契約が更新されます。',
        ],
        'unit_price' => 300,
        'quantity' => 10,
    ];
}