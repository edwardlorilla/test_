<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimezoneToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
 	{
 		Schema::table('users', function(Blueprint $table)
 		{
 			$table->string('timezone', 255)->nullable()->after('confirmed');
 		});
 	}


 	/**
 	 * Reverse the migrations.
 	 *
 	 * @return void
 	 */
 	public function down()
 	{
 		Schema::table('users', function(Blueprint $table)
 		{
 			$table->dropColumn('timezone');
 		});
 	}
}
