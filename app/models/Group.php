<?php

use LaravelBook\Ardent\Ardent;

class Group extends Ardent {
	protected $table = 'groups';
	protected $fillable = [];

	protected $guardable = ['id'];

	public $autoPurgeRedundantAttributes = true;

	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	);
}
