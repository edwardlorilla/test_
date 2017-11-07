<?php

class StoryTeamMember extends Eloquent {

	public function story()
	{
		return $this->belongsTo('Story');
	}
	
	public function user()
	{
		return $this->hasMany('User', 'id', 'user_id');
	}
}