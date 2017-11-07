<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewsClear extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'view:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear views folder';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->files = new \Illuminate\Filesystem\Filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		foreach ($this->files->files(storage_path().'/views') as $file)
		{
			$this->files->delete($file);
		}

		$this->info('Views deleted from cache');
	}
}
