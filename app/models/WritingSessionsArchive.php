<?php
use LaravelBook\Ardent\Ardent;

class WritingSessionsArchive extends Ardent {
	protected $fillable = [	'is_ninja_mode',
							'word_count',
							'words_per_minute',
							'session_started_at',
							'session_ended_at'];

	protected $guardable = ['id',
							'user_id'];

	public $autoPurgeRedundantAttributes = true;
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
