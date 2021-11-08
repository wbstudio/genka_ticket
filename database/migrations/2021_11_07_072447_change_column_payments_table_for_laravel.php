<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPaymentsTableForLaravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('user_id', 'customer_id');
            $table->renameColumn('stripe_charge_id', 'stripe_charge_key');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('stripe_charge_key', 'stripe_charge_id');
            $table->renameColumn('customer_id', 'user_id');
        });
    }
}
