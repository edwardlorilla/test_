<?php
use LaravelBook\Ardent\Ardent;

class MarketingProgram extends Ardent {
	protected $table = 'marketing_program';
	protected $fillable = [];
	protected $guardable = ['*'];

	public $autoPurgeRedundantAttributes = true;


	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	);
}