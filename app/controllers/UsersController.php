<?php

class UsersController extends BaseController {
    public function show($id)
    {

    }

    public function profile()
    {

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