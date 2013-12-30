<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class AdminUser extends Eloquent implements UserInterface, RemindableInterface {

    protected $hidden = array(
        'created_at', 'updated_at', 'api_key', 'password', 'fb_access_token'
    );

    static protected $rules = array(
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

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

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$rules[$ignored_field]);
            }
        }
        $validator = Validator::make($input, self::$rules);
        return $validator;
    }

    static public function createUser($data)
    {
        $user = self::where('email', $data['email'])->first();
        if (!$user)
        {
            $user = new self();
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            if ($user->save())
            {
                return $user;
            }
        }
        return false;
    }

    static public function updateUser($id, $data)
    {
        $user = self::find($id);
        if ($user)
        {
            if ($user->email != $data['email'])
            {
                // email changed, notify both mail addresses
                $user->email = $data['email'];
            }

            $new_password = Hash::make($data['password']);
            if (!empty($data['password']) && $user->password != $new_password)
            {
                // password changed, do something about it
                $user->password = $new_password;
            }
            if ($user->save())
            {
                return $user;
            }
        }
        return false;
    }

}