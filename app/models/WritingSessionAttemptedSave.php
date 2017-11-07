<?php

use Eloquent;

class WritingSessionAttemptedSave extends Eloquent {
	protected $table = 'writing_session_attempted_save';
	protected $fillable = ['*'];


    public function getContentInProgressAttribute($value)
    {
    	// Had to include this code because PHP was bombing
    	// at trying to decrypt an empty string.
    	if (strlen($value) > 0)
    	{
	        return Crypt::decrypt($value);
    	}
    	else
    	{
    		return '';
    	}
    }

    public function setContentInProgressAttribute($value)
    {
        $this->attributes['content_in_progress'] = Crypt::encrypt($value);
    }
}