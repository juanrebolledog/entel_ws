<?php
class AdminSummersController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'summers'));
        });
    }
    public function index()
    {
        $summers = Summer::with('category')->get();
        return $this->layout->content = View::make('admin_summers.index')->with(array('summers' => $summers));
    }

    public function show($id)
    {
        $summer = Summer::with('category')->find($id);
        return $this->layout->content = View::make('admin_summers.show')->with(array('summer' => $summer));
    }

    public function create()
    {
        if (Session::get('summer_error'))
        {
            Eloquent::unguard();
            $summer = new Summer(Session::get('summer_error'));
        }
        else
        {
            $summer = new Summer();
        }
        $summer_categories = SummerCategory::get()->lists('nombre', 'id');
        return $this->layout->content = View::make('admin_summers.create', array('summer' => $summer, 'categories' => $summer_categories));
    }

    public function store()
    {
        $data = Input::all();

        $validator = Summer::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('AdminSummersController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $summer = Summer::createSummer($data);
            if ($summer->exists)
            {
                return Redirect::to(action('AdminSummersController@show', $summer->id));
            }
        }
    }

    public function edit($id)
    {
        $summer = Summer::find($id);
        $summer_categories = EventSubCategory::all();
        $categories = array();
        foreach ($summer_categories as $cat)
        {
            $categories[$cat->id] = $cat->nombre;
        }
        return $this->layout->content = View::make('admin_summers.edit', array('summer' => $summer, 'categories' => $categories));
    }

    public function update($id)
    {
        $data = Input::all();

        $summer_validator = Summer::validate($data, array('except' => array('imagen_descripcion', 'imagen_titulo', 'imagen_banner')));

        if ($summer_validator->fails())
        {
            return Redirect::to(action('AdminSummersController@edit', $id))->withErrors($summer_validator)->withInput();
        }
        else
        {
            $summer = Summer::updateSummer($id, $data);
            if ($summer->exists)
            {
                return Redirect::to(action('AdminSummersController@show', $summer->id));
            }
        }
    }

    public function disableToggle($id)
    {
        Summer::disableEventToggle($id);
        return Redirect::to(action('AdminEventsController@index'));
    }
} 