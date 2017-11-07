<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWritingSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('writing_sessions', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();

			// story_session_token will be used to
			// allow the user to write to the database
			// even if their user account timed out
			$table->string('writing_session_token');

			// story_session_settings will be the json
			// description of the session settings
			$table->string('writing_session_settings');
			$table->longtext('content_in_progress');
			$table->integer('words_to_write');
			$table->integer('word_count');
			$table->integer('words_per_minute');
			$table->dateTime('session_started_at');
			$table->dateTime('session_ended_at');
			$table->string('local_storage_updated_at');
			
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
		Schema::drop('writing_sessions');
	}

}
