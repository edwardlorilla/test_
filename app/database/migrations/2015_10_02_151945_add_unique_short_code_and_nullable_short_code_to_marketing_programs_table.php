<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueShortCodeAndNullableShortCodeToMarketingProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketing_program', function(Blueprint $table)
		{
			$table->unique('short_code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('marketing_program', function(Blueprint $table)
		{
			$table->dropUnique('marketing_program_short_code_unique');
		});
	}

}
