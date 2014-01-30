<?php

class AdminZonesController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'zones'));
        });
    }

    public function index()
    {
        $zones = Zone::getZones();
        return $this->layout->content = View::make('admin_zones.index')->with(array('zones' => $zones));
    }

    public function show($id)
    {
        $zone = Zone::getZone($id);
        return $this->layout->content = View::make('admin_zones.show')->with(array('zone' => $zone));
    }

    public function create()
    {
        $zone = new Zone();
        $categories = ZoneCategory::lists('nombre', 'id');
        return $this->layout->content = View::make('admin_zones.create', array('zone' => $zone, 'categories' => $categories));
    }

    public function store()
    {
        $data = Input::all();

        $zone_validator = Zone::validate($data);

        if ($zone_validator->fails())
        {
            return Redirect::to(action('AdminZonesController@create'))->withErrors($zone_validator)->withInput();
        }
        else
        {
            $zone = Zone::createZone($data);
            if ($zone->exists)
            {
                return Redirect::to(action('AdminZonesController@show', $zone->id));
            }
        }
    }

    public function edit($id)
    {
        $zone = Zone::find($id);
        $categories = ZoneCategory::lists('nombre', 'id');
        return $this->layout->content = View::make('admin_zones.edit', array('zone' => $zone, 'categories' => $categories));
    }

    public function update($id)
    {
        $data = Input::all();

        $zone_validator = Zone::validate($data, array('except' => array('imagen', 'imagen_web')));

        if ($zone_validator->fails())
        {
            return Redirect::to(action('AdminZonesController@edit', $id))->withErrors($zone_validator)->withInput();
        }
        else
        {
            $zone = Zone::updateZone($id, $data);
            if ($zone->exists)
            {
                return Redirect::to(action('AdminZonesController@show', $zone->id));
            }
        }
    }

    public function delete($id)
    {

    }

}