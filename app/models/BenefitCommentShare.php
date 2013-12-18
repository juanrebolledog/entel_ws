<?php
class BenefitCommentShare extends BaseModel {
    protected $table = 'comentarios_compartidos';

    static protected $allowedShareMethods = array(
        'twitter', 'facebook', 'mail'
    );

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    static public function saveShare($comment_id, $user_id, $method)
    {
        if (!in_array($method, self::$allowedShareMethods))
        {
            return false;
        }
        $share_object = self::where(function($q) use ($comment_id, $user_id, $method)
        {
            $q->where('comentario_id', $comment_id);
            $q->where('usuario_id', $user_id);
            $q->where('metodo', $method);
        })->get();
        if (count($share_object) == 0)
        {
            $share_object = new self();
            $share_object->comentario_id = $comment_id;
            $share_object->usuario_id = $user_id;
            $share_object->metodo = $method;
            if ($share_object->save())
            {
                return $share_object;
            }
        }
        else
        {
            return $share_object;
        }
        return false;
    }
} 