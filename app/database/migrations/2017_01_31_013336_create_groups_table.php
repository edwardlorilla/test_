<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner_user_id')->unsigned()->index();
			$table->string('name');
			$table->timestamps();
			$table->unique(array('owner_user_id', 'name'));
			$table->foreign('owner_user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
