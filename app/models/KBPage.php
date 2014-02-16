<?php

class KBPage extends BaseModel {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'ayuda_kb';

	public $timestamps = false;

	static public function getAll()
	{
		$pages = self::all();
		$pages->each(function($page)
		{
			$page->articulos = json_decode($page->articulos, true);
			$page->prepareForWS();
		});
		return $pages;
	}

	public function prepareForWS()
	{
		$this->cover = asset($this->cover);
		$this->icono = asset($this->icono);
		return $this;
	}
}
