<?php
use LaravelBook\Ardent\Ardent;

class DailyWritingLog extends Ardent {
	protected $table = 'daily_writing_log';	
	protected $fillable = [ 'user_id',
							'date',
							'daily_word_count', 
							'average_words_per_minute'];

	protected $guardable = ['id'];

	public $autoPurgeRedundantAttributes = true;

	/* schema
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->dateTime('date');
			$table->integer('daily_word_count');
			$table->integer('average_words_per_minute');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	*/

	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	);

	/* User relationship */
	public function user()
	{
		return $this->belongsTo('User');
	}
}