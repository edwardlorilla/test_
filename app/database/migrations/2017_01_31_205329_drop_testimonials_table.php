<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTestimonialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('testimonials');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('testimonials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('testimonial');
			$table->boolean('active')->default(0);
			$table->timestamps();
		});
	}
}
