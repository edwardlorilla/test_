<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangedCopyFieldTypeInMarketingProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('marketing_program', function($table)
		{
			$table->longText('new_copy')->after('copy');
		});
		
		$mps = MarketingProgram::all();
		
		$mps->each(function($mp)
		{
			$mp->new_copy = $mp->copy;
			$mp->save();
		});
			
		Schema::table('marketing_program', function($table)
		{
			$table->dropColumn('copy');
			$table->renameColumn('new_copy', 'copy');			
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('marketing_program', function($table)
		{
			$table->string('old_copy')->after('copy');
		});
		
		$mps = MarketingProgram::all();
		
		$mps->each(function($mp)
		{
			$mp->old_copy = $mp->copy;
			$mp->save();
		});
		
		Schema::table('marketing_program', function($table)
		{
			$table->dropColumn('copy');
			$table->renameColumn('old_copy', 'copy');			
		});			
	}
}
