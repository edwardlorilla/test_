<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNameToStoryContents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('story_contents', function(Blueprint $table)
		{
			$table->text('name')->after('story_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('story_contents', function(Blueprint $table)
		{
			$table->dropColumn('name');
		});
	}

}
