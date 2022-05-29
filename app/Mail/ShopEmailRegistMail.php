<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShopEmailRegistMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->shopData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('mail.shop.shopEmailRegistMail')
                    ->from('XXX@XXXX','Test')
                    ->subject('【原価ticket】ご登録ありがとうございます。')
                    ->with(['shopData' => $this->shopData]);;
    }
}
