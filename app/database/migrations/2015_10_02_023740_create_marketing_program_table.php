<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_program', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('short_code');
			$table->string('copy');
			$table->string('stripe_plan');
			$table->string('stripe_data_description');
			$table->string('stripe_data_amount');
			$table->boolean('active')->default(false);
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
		Schema::drop('marketing_program');
	}

}
