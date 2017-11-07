<?php
use LaravelBook\Ardent\Ardent;

class SystemRequestResponseLog extends Ardent {
	protected $table = 'system_request_response_log';
	protected $fillable = [];
	protected $guardable = ['*'];

	public $autoPurgeRedundantAttributes = true;


	/*
	 * Ardent validation rules
	 */
	public static $rules = array(
	);
}