<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->comment('カスタマーID');
            $table->string('email')->comment('アドレス');
            $table->string('title')->nullable()->comment('タイトル');
            $table->text('main')->comment('本文');
            $table->integer('response')->default(0)->comment('レスポンス');
            $table->integer('status')->comment('回答者');
            $table->string('memo')->nullable()->comment('メモ');
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
        Schema::dropIfExists('contact_customers');
    }
}
