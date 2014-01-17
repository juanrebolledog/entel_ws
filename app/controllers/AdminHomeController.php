<?php

class AdminHomeController extends AdminBaseController {

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			View::share('data', array('current' => 'home'));
		});
	}

	public function index()
	{
		$this->layout->content = View::make('admin_home.index');
	}

}