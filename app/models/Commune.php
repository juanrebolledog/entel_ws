<?php

class Commune extends BaseModel {
    protected $guarded = array();

    public static $rules = array();

    protected $table = 'comunas';

	public $timestamps = false;

    public function region()
    {
        return $this->belongsTo('Region', 'region_id');
    }
}
