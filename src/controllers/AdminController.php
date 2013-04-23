<?php namespace Orchestra\Foundation;

use Event;

abstract class AdminController extends BaseController {

	/**
	 * Define the filters.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		// Admin controllers should be accessible only after 
		// Orchestra Platform is installed.
		$this->beforeFilter('orchestra.installable');

		Event::fire('orchestra.started: admin');
	}
}