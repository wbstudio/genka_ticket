<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->integer('station_cd')->comment('駅コード');
            $table->string('station_name')->comment('駅名');
            $table->integer('line_cd')->comment('路線コード');
            $table->integer('pref_cd')->comment('都道府県コード');
            $table->string('lon')->comment('経度か緯度');
            $table->string('lat')->comment('経度か緯度');
            $table->integer('status')->comment('運営状況');
            $table->integer('sort')->comment('順番');
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
        Schema::dropIfExists('stations');
    }
}
