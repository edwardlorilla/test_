<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWritingSessionsArchiveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('writing_sessions_archives', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->boolean('is_ninja_mode');
			$table->integer('words_to_write');
			$table->integer('word_count');
			$table->integer('words_per_minute');
			$table->dateTime('session_started_at');
			$table->dateTime('session_ended_at');
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
		Schema::drop('writing_sessions_archives');
	}

}
