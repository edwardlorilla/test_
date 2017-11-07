<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortColumnToStoryContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
 	{
 		Schema::table('story_contents', function(Blueprint $table)
 		{
 			$table->integer('sort_id')->after('story_id');
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
 			$table->dropColumn('sort_id');
 		});
 	}
}
