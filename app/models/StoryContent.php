<?php
use LaravelBook\Ardent\Ardent;

class StoryContent extends Ardent {
	protected $fillable = ['story_id', 'content'];
	protected $guardable = ['*'];

	public $autoPurgeRedundantAttributes = true;

	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
		'story_id'					=> 'required|integer',
		'name'						=> 'required',
		'content'					=> 'required',
		'word_count'				=> 'required|integer'
	);

    public function getContentAttribute($value)
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

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = Crypt::encrypt($value);
    }


	/* Story relationship */
	public function story()
	{
		return $this->belongsTo('Story');
	}
}
