<?php

class AdminZonePagesController extends AdminBaseController {

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			View::share('data', array('current' => 'zones'));
		});
	}

	public function index()
	{
		$pages = Page::getAll();
		return $this->layout->content = View::make('admin_zone_pages.index')->with(array('pages' => $pages));
	}

	public function show($id)
	{
		$page = Page::getPage($id);
		$keys = array(
			'icono', 'href', 'texto', 'link', 'super_titulo', 'categoria', 'tipos', 'imagen', 'imagen_titulo', 'titulo',
			'texto_como', 'texto_cuando', 'texto_recuerda', 'beneficios_1_titulo', 'beneficios_1_texto',
			'beneficios_2_titulo', 'beneficios_2_texto', 'beneficios_3_titulo', 'beneficios_3_texto'
		);
		return $this->layout->content = View::make('admin_zone_pages.show')->with(array('page' => $page, 'keys' => $keys));
	}

	public function create()
	{
		$zone = new Zone();
		$categories = ZoneCategory::lists('nombre', 'id');
		return $this->layout->content = View::make('admin_zone_pages.create', array('zone' => $zone, 'categories' => $categories));
	}

	public function store()
	{
		$data = Input::all();

		$zone_validator = Zone::validate($data);

		if ($zone_validator->fails())
		{
			return Redirect::to(action('AdminZonePagesController@create'))->withErrors($zone_validator)->withInput();
		}
		else
		{
			$zone = Zone::createZone($data);
			if ($zone->exists)
			{
				return Redirect::to(action('AdminZonePagesController@show', $zone->id));
			}
		}
	}

	public function edit($id)
	{
		$zone = Zone::find($id);
		$categories = ZoneCategory::lists('nombre', 'id');
		return $this->layout->content = View::make('admin_zone_pages.edit', array('zone' => $zone, 'categories' => $categories));
	}

	public function update($id)
	{
		$data = Input::all();

		$zone_validator = Zone::validate($data, array('except' => array('imagen', 'imagen_web')));

		if ($zone_validator->fails())
		{
			return Redirect::to(action('AdminZonePagesController@edit', $id))->withErrors($zone_validator)->withInput();
		}
		else
		{
			$zone = Zone::updateZone($id, $data);
			if ($zone->exists)
			{
				return Redirect::to(action('AdminZonePagesController@show', $zone->id));
			}
		}
	}

	public function delete($id)
	{

	}

}