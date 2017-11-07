<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailMessageSentToTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_message_sent_to', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('email_message_id')->unsigned();
			$table->string('email');
			$table->foreign('email_message_id')->references('id')->on('email_messages')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_message_sent_to');
	}

}
