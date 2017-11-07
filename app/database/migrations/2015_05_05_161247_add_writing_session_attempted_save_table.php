<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddWritingSessionAttemptedSaveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('writing_session_attempted_save', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->text('content_in_progress');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('writing_session_attempted_save');
	}
}
