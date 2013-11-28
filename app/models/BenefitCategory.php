<?php
class BenefitCategory extends BaseModel {
    protected $table = 'categorias_beneficios';
    public $timestamps = false;

    public function sub_categories()
    {
        return $this->hasMany('BenefitSubCategory', 'categoria_id');
    }
} 