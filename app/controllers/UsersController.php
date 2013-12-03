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
            'nombres' => $user->nombres,
            'rut' => $user->rut,
            'telefono_movil' => $user->telefono_movil
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
        else
        {
            $this->setApiResponse(array(), false, 'User invalid or already exists');
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