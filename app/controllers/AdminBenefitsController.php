<?php
class AdminBenefitsController extends AdminBaseController {

    protected $layout = 'admin_layout';

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'benefits'));
        });
    }

    public function index()
    {
        $benefits = Benefit::with('sub_category')->where('caducado', false)->get();
        return $this->layout->content = View::make('admin_benefits.index')->with(array('benefits' => $benefits));
    }

    public function show($id)
    {
        $benefit = Benefit::with('sub_category', 'comments')->find($id);
        return $this->layout->content = View::make('admin_benefits.show')->with(array('benefit' => $benefit));
    }

    public function create()
    {
        $benefit = new Benefit();
        $benefit_categories = BenefitSubCategory::lists('nombre', 'id');
        return $this->layout->content = View::make('admin_benefits.create', array('benefit' => $benefit, 'categories' => $benefit_categories));
    }

    public function store()
    {
        $data = Input::all();

        $validator = Benefit::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitsController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $benefit = Benefit::createBenefit($data);
            if ($benefit->exists)
            {
                return Redirect::to(action('AdminBenefitsController@show', $benefit->id));
            }
        }
    }

    public function edit($id)
    {
        $benefit = Benefit::find($id);
        $benefit_categories = BenefitSubCategory::all();
        $categories = array();
        foreach ($benefit_categories as $cat)
        {
            $categories[$cat->id] = $cat->nombre;
        }
        return $this->layout->content = View::make('admin_benefits.edit', array('benefit' => $benefit, 'categories' => $categories));
    }

    public function update($id)
    {
        $data = Input::all();

        $validator = Benefit::validate($data, array('except' => array('icono', 'imagen_grande', 'imagen_grande_web', 'imagen_chica', 'imagen_titulo')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitsController@edit', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $benefit = Benefit::updateBenefit($id, $data);
            if ($benefit->exists)
            {
                return Redirect::to(action('AdminBenefitsController@show', $benefit->id));
            }
        }
    }

    public function disableToggle($id)
    {
        Benefit::disableBenefitToggle($id);
        return Redirect::to(action('AdminBenefitsController@index'));
    }
} 