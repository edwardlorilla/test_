<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoryTeamMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('story_team_members', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('story_id')->unsigned();
      $table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->unique(array('story_id', 'user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('story_team_members');
	}}
