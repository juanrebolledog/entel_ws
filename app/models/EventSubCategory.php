<?php
class EventSubCategory extends BaseModel {
    protected $table = 'sub_categorias_eventos';
    public $timestamps = false;

    public function events()
    {
        return $this->hasMany('AppEvent', 'sub_categoria_id');
    }
} 