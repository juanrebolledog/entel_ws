<?php
class EventComment extends BaseModel {
    protected $table = 'comentarios_eventos';

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }
} 