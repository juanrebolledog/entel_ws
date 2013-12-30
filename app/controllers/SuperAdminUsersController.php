<?php
class SuperAdminUsersController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'super_users'));
        });
    }

    public function profile()
    {
        $user = AdminUser::first();
        return View::make('super_admin_users.profile', array('user' => $user));
    }

    public function index()
    {
        $users = AdminUser::all();
        return View::make('super_admin_users.index', array('users' => $users->toArray()));
    }

    public function show($id)
    {
        $user = AdminUser::find($id);
        return View::make('super_admin_users.show', array('user' => $user));
    }

    public function create()
    {
        $user = new AdminUser();
        return View::make('super_admin_users.create', array('user' => $user));
    }

    public function store()
    {
        $data = Input::all();

        $validator = AdminUser::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('SuperAdminUsersController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $user = AdminUser::createUser($data);
            if ($user->exists)
            {
                return Redirect::to(action('SuperAdminUsersController@show', $user->id));
            }
        }
    }

    public function edit($id)
    {
        $user = AdminUser::find($id);
        return $this->layout->content = View::make('super_admin_users.edit', array('user' => $user));
    }

    public function update($id)
    {
        $data = Input::all();
        $except_fields = array();
        if (empty($data['password']))
        {
            array_push($except_fields, 'password');
            array_push($except_fields, 'password_confirmation');
        }
        $validator = AdminUser::validate($data, array('except' => $except_fields));

        if ($validator->fails())
        {
            return Redirect::to(action('SuperAdminUsersController@edit', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $user = AdminUser::updateUser($id, $data);
            if ($user->exists)
            {
                return Redirect::to(action('SuperAdminUsersController@show', $user->id));
            }
        }
    }

    public function destroy($id)
    {

    }

    public function toggle_status($id)
    {

    }

}