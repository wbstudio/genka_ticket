<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メール認証日時');
            $table->string('password')->comment('パスワード');
            $table->rememberToken()->comment('ログイン省略トークン');
            $table->integer('kind')->comment('店舗種別');
            $table->string('category')->nullable()->comment('カテゴリー');
            $table->string('adress')->nullable()->comment('住所');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('business_hour')->nullable()->comment('営業時間');
            $table->string('xaxis')->nullable()->comment('X軸');
            $table->string('yaxis')->nullable()->comment('Y軸');
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
        Schema::dropIfExists('shops');
    }
}
