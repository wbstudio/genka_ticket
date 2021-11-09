<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('ID');
			$table->integer('user_id')->comment('ユーザーID');
			$table->string('email')->comment('メールアドレス');
			$table->string('stripe_subscription_id')->comment('StripeサブスクリプションID');
			$table->date('start_on')->comment('開始日');
			$table->date('end_on')->nullable()->comment('終了日');
			$table->date('next_payment_on')->comment('次回請求日');
			$table->integer('times')->default(1)->comment('継続回数');
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
		Schema::drop('subscriptions');
	}

}
