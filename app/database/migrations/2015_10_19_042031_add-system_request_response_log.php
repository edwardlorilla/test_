<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSystemRequestResponseLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_request_response_log', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->nullable();
			$table->text('request')->nullable();
			$table->text('response')->nullable();
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
		Schema::drop('system_request_response_log');
	}
}
