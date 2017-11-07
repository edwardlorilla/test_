<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProModeColumnToWritingSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('writing_sessions', function(Blueprint $table)
		{
			$table->boolean('is_ninja_mode')->default(0)->after('content_in_progress');
		});

		Schema::table('writing_sessions', function(Blueprint $table)
		{
			$table->dropColumn('writing_session_settings');
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('writing_sessions', function(Blueprint $table)
		{
			$table->dropColumn('is_ninja_mode');
		});	

		Schema::table('writing_sessions', function(Blueprint $table)
		{
			$table->string('writing_session_settings');
		});
	}
}
