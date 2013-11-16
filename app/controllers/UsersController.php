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
        $this->setApiResponse($profile, true);
        return Response::json($this->api_response);
    }

    public function store()
    {
        $data = Input::all();

        if ($user = User::createUser($data))
        {
            $this->setApiResponse($user->toArray(), true);
        }
        return Response::json($this->api_response);
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