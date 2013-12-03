<?php
class AdminUsersController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'users'));
        });
    }

    public function index()
    {
        $users = User::all();
        return View::make('admin_users.index', array('users' => $users->toArray()));
    }

    public function show($id)
    {
        $users = User::all();
        return View::make('admin_users.index', array('users' => $users->toArray()));
    }

}