<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メール認証日時');
            $table->string('password')->comment('パスワード');
            $table->rememberToken()->comment('ログイン省略トークン');
            $table->integer('ticket')->comment('チケット枚数');
            $table->dateTime('birthday')->nullable()->comment('誕生日');
            $table->integer('sex')->nullable()->comment('性別');
            $table->integer('status')->default(2)->comment('ステータス');
            $table->integer('stripe_customer_id')->nullable()->comment('Stripe支払いID');
            $table->integer('stripe_payment_method_id')->nullable()->comment('Stripe支払い方法');
            $table->integer('delete_flag')->default(0)->comment('削除フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
