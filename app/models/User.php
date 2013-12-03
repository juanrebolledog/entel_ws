<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    static protected $validation = array(
        'nombres' => 'required',
        'apellidos' => 'required',
        'rut' => 'required',
        'telefono_movil' => 'required',
        'email' => 'required'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    static public function createUser($data)
    {
        $user = User::where('rut', $data['rut'])->first();
        if (!$user)
        {
            $user = new User();
            $user->nombres = $data['nombres'];
            $user->apellidos = $data['apellidos'];
            $user->rut = $data['rut'];
            $user->telefono_movil = $data['telefono_movil'];
            $user->email = $data['email'];
            $user->fb_id = isset($data['fb_id']) ? $data['fb_id'] : null;
            $user->api_key = hash('sha256', $user->cellphone_number . $user->rut);
            $user->password = hash('sha256', $user->api_key . Request::header('ENTEL-ACCESS-KEY'));

            $user_array = $user->toArray();
            $user_validator = Validator::make($user_array, self::$validation);
            if ($user_validator->fails())
            {
                if ($user->save())
                {
                    return $user;
                }
            }
        }
        return false;
    }

}