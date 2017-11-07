<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrialWordsToMarketingProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketing_program', function(Blueprint $table)
		{
			$table->text('free_trial_word_count_limit')->after('copy');
			$table->text('partner_name')->after('free_trial_word_count_limit');
			$table->text('notification_email')->after('partner_name');
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
			$table->dropColumn('free_trial_word_count_limit', 'partner_name', 'notification_email');
		});
	}

}
