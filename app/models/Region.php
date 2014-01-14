<?php

class Region extends BaseModel {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'regiones';

	public $timestamps = false;

	public function communes()
	{
		return $this->hasMany('Commune', 'region_id');
	}

	static public function getRegions()
	{
		$regions = self::with('communes')->get();
		return $regions;
	}
}
