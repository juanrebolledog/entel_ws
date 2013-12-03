<?php
class EventCategory extends BaseModel {
    protected $table = 'categorias_eventos';
    public $timestamps = false;

    public function sub_categories()
    {
        return $this->hasMany('EventSubCategory', 'categoria_id');
    }
} 