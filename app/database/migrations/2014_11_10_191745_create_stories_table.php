<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stories', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->text('name');
			$table->integer('total_word_count');
			$table->integer('average_words_per_minute');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		Schema::create('story_contents', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('story_id')->unsigned()->index();
			$table->longtext('content');
			$table->integer('word_count');
			$table->integer('words_per_minute');
			$table->timestamps();
			$table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('story_contents');
		Schema::drop('stories');
	}

}
