<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $hidden = array(
        'created_at', 'updated_at', 'api_key', 'password', 'fb_access_token'
    );

    static protected $validation = array(
        'nombres' => 'required',
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

    public function comments()
    {
        return $this->hasMany('BenefitComment', 'usuario_id');
    }

    public function benefits()
    {
        return $this->hasMany('BenefitRedeem', 'usuario_id');
    }

    public function ignored_benefits()
    {
        return $this->hasMany('BenefitIgnore', 'usuario_id');
    }

    public function votes()
    {
        return $this->hasMany('BenefitVote', 'usuario_id');
    }

    public function events()
    {

    }

    public function level()
    {
        return $this->belongsTo('UserLevel', 'nivel_id');
    }

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
            $user_lvl = UserLevel::where('beneficios', 0)->first();
            $user = new User();
            $user->nivel_id = $user_lvl->id;
            $user->nombres = $data['nombres'];
            $user->rut = $data['rut'];
            $user->telefono_movil = $data['telefono_movil'];
            $user->email = $data['email'];
            $user->fb_id = isset($data['fb_id']) ? $data['fb_id'] : null;
            $user->api_key = hash('sha256', $user->cellphone_number . $user->rut . time());
            $user->password = hash('sha256', $user->api_key . Request::header('ENTEL-ACCESS-KEY'));

            $user_array = $user->toArray();
            $user_validator = Validator::make($user_array, self::$validation);
            if (!$user_validator->fails())
            {
                unset($user->hidden[2]);
                if ($user->save())
                {
                    return $user;
                }
            }
        }
        else
        {
            $user->nombres = $data['nombres'];
            $user->telefono_movil = $data['telefono_movil'];
            $user->email = $data['email'];
            $user->fb_id = isset($data['fb_id']) ? $data['fb_id'] : null;
            $user->api_key = hash('sha256', $user->cellphone_number . $user->rut . time());
            $user->password = hash('sha256', $user->api_key . Request::header('ENTEL-ACCESS-KEY'));

            $user_array = $user->toArray();
            $user_validator = Validator::make($user_array, self::$validation);
            if (!$user_validator->fails())
            {
                unset($user->hidden[2]);
                if ($user->save())
                {
                    return $user;
                }
            }
        }
        return false;
    }

}