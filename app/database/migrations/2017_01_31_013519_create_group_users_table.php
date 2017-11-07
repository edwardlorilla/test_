<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->boolean('can_view_group_stats')->default(0);
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
			$table->unique(array('group_id', 'user_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_users');
	}

}
