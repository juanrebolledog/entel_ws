<?php

class UsersController extends BaseController {

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

        $validator = User::validate($data);

        if ($validator->passes())
        {
            if ($user = User::createUser($data))
            {
                $this->setApiResponse($user->toArray(), true);
            }
            else
            {
                // serio problema entonces, avísale a alguien.
                $this->setApiResponse(false, false, 'Error desconocido');
            }
        }
        else
        {
            $this->setApiResponse($validator->messages()->toArray(), false, 'Usuario inválido o no existe. Errores en "data".');
        }
        return Response::json($this->api_response);
    }

    public function level()
    {
        $user = Auth::getUser();
        $level = UserLevel::getLevel($user->nivel_id);
        $this->setApiResponse($level->toArray(), true);
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