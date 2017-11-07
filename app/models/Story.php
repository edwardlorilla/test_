<?php
use LaravelBook\Ardent\Ardent;

class Story extends Ardent {
	protected $fillable = ['user_id', 'name'];
	protected $guardable = ['*'];

	public $autoPurgeRedundantAttributes = true;
	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	    'user_id'               		=> 'required|integer',
	    'name'                  		=> 'required',
	    'total_word_count'      		=> 'required|integer'
	);

	/* User relationship */
	public function user()
	{
		return $this->belongsTo('User');
	}

    public function story_contents()
    {
        return $this->hasMany('StoryContent');
    }
}
