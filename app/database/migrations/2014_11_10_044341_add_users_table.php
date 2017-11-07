<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('free_trial_word_count_limit')->default(0)->after('confirmed');
			$table->integer('total_words_written')->default(0)->after('free_trial_word_count_limit');
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
			$table->dropColumn('free_trial_word_count_limit');
			$table->dropColumn('total_words_written');
		});
	}

}
