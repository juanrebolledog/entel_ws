<?php

class UsersController extends BaseController {
    public function show($id)
    {

    }

    public function profile()
    {
        $user = Auth::getUser();
        $profile = array(
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'rut' => $user->rut,
            'cellphone_number' => $user->cellphone_number
        );
        return Response::json(array('data' => $profile, 'status' => true));
    }

    public function store()
    {
        $response = array(
            'data' => array(),
            'status' => false
        );
        $data = Input::all();

        if ($user = User::createUser($data))
        {
            $response['data'] = $user->toArray();
            $response['status'] = true;
        }
        return Response::json($response);
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function achievements()
    {

    }

    public function unlocked()
    {

    }
} 