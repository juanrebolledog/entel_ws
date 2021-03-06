<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $hidden = array(
        'created_at', 'updated_at', 'api_key', 'password', 'fb_access_token'
    );

    static protected $rules = array(
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
        $user = User::where('rut', $data['rut'])->first();
        if (!$user)
        {
            $user_lvl = UserLevel::where('beneficios', 1)->first();
            $user = new User();
            $user->nivel_id = $user_lvl->id;
            $user->nombres = $data['nombres'];
            $user->rut = $data['rut'];
            $user->telefono_movil = $data['telefono_movil'];
            $user->email = $data['email'];
            $user->fb_id = isset($data['fb_id']) ? $data['fb_id'] : null;
            $user->api_key = hash('sha256', $user->cellphone_number . $user->rut . time());
            $user->password = hash('sha256', $user->api_key);

            $user_array = $user->toArray();
            $user_validator = Validator::make($user_array, self::$rules);
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
            $user_validator = Validator::make($user_array, self::$rules);
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

    public function recalculateLevel()
    {
        $redeemed_benefit_count = BenefitRedeem::where('usuario_id', $this->id)->count();
        $b_comments = BenefitComment::where('usuario_id', $this->id)->get();
        $e_comments = EventComment::where('usuario_id', $this->id)->get();
        $comment_count = $fb_share_count = $tw_share_count = 0;
        foreach ($b_comments as $comment)
        {
            $comment_count++;
            if ($comment->compartido_fb)
            {
                $fb_share_count++;
            }

            if ($comment->compartido_tw)
            {
                $tw_share_count++;
            }
        }

        foreach ($e_comments as $comment)
        {
            $comment_count++;
            if ($comment->compartido_fb)
            {
                $fb_share_count++;
            }

            if ($comment->compartido_tw)
            {
                $tw_share_count++;
            }
        }
        $share_count = $fb_share_count + $tw_share_count;

        Log::info(json_encode(array(
            'benefits' => $redeemed_benefit_count,
            'comments' => $comment_count,
            'shares' => $share_count
        )));

        $levels = UserLevel::where(function($query) use ($redeemed_benefit_count, $comment_count, $share_count)
        {
            $query->where('beneficios', '<=', $redeemed_benefit_count);
            $query->where('comentarios', '<=', $comment_count);
            $query->where('compartir', '<=', $share_count);
        })->get();

        if ($levels)
        {
            Log::info(json_encode($levels->toArray()));
            $this->nivel_id = $levels->last()->id;
            if ($this->save())
            {
                return true;
            }
        }
        return false;
    }

}