<?php

class BenefitSubCategory extends BaseModel {
    protected $table = 'sub_categorias_beneficios';
    public $timestamps = false;

    public function benefits()
    {
        return $this->hasMany('Benefit', 'sub_categoria_id');
    }
} 