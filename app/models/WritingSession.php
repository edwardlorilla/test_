<?php
use LaravelBook\Ardent\Ardent;

class WritingSession extends Ardent {
	protected $fillable = [ 'content_in_progress',
							'is_ninja_mode',
							'word_count',
							'words_per_minute',
							'session_started_at',
							'session_ended_at'];

	protected $guardable = ['id',
							'user_id',
							'writing_session_token'];

	public $autoPurgeRedundantAttributes = true;

	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	);

    public function setWritingSessionTokenAttribute($value)
    {
        $this->attributes['writing_session_token'] = Crypt::encrypt($value);
    }

    public function getContentInProgressAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function setContentInProgressAttribute($value)
    {
        $this->attributes['content_in_progress'] = Crypt::encrypt($value);
    }

	/* User relationship */
	public function user()
	{
		return $this->belongsTo('User');
	}
}
