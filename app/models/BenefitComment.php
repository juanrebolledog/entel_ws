<?php
class BenefitComment extends BaseModel {
    protected $table = 'comentarios';
    protected $hidden = array(
        'created_at', 'updated_at'
    );
    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function shared()
    {
        return $this->hasMany('BenefitCommentShare', 'comentario_id');
    }
} 