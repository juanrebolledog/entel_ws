<?php
class BenefitComment extends BaseModel {
    protected $table = 'comentarios';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static protected $allowedShareMethods = array(
        'twitter', 'facebook'
    );

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    static public function saveShare($comment_id, $user_id, $method)
    {
        if (!in_array($method, self::$allowedShareMethods))
        {
            return false;
        }
        $comment = self::find($comment_id);

        if ($comment)
        {
            if ($comment->usuario_id == $user_id)
            {
                if ($method == 'facebook')
                {
                    $comment->compartido_fb = 1;
                }

                if ($method == 'twitter')
                {
                    $comment->compartido_tw = 1;
                }
            }

            if ($comment->save())
            {
                Auth::getUser()->recalculateLevel();
                return $comment;
            }
        }
        else
        {
            return $comment;
        }
        return false;
    }
} 