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
        $benefits = Benefit::all();
        return $this->layout->content = View::make('admin_benefits.index')->with(array('benefits' => $benefits));
    }

    public function show($id)
    {
        $benefit = Benefit::find($id);
        return $this->layout->content = View::make('admin_benefits.show')->with(array('benefit' => $benefit));
    }

    public function create()
    {
        $benefit = new Benefit();
        $benefit_categories = BenefitSubCategory::all();
        $categories = array();
        foreach ($benefit_categories as $cat)
        {
            $categories[$cat->id] = $cat->nombre;
        }
        return $this->layout->content = View::make('admin_benefits.create', array('benefit' => $benefit, 'categories' => $categories));
    }

    public function store()
    {
        $data = Input::all();

        $benefit_validator = Benefit::validate($data);

        if ($benefit_validator->fails())
        {
            return Redirect::to('admin/benefits/create')->withErrors($benefit_validator)->withInput();
        }
        else
        {
            $benefit = Benefit::createBenefit($data);
            if ($benefit->exists)
            {
                return Redirect::to('admin/benefits/' . $benefit->id);
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

        $benefit_validator = Benefit::validate($data, array('except' => array('imagen_titulo', 'imagen_grande', 'icono', 'imagen_chica')));

        if ($benefit_validator->fails())
        {
            return Redirect::to('admin/benefits/' . $id . '/edit')->withErrors($benefit_validator)->withInput();
        }
        else
        {
            $benefit = Benefit::updateBenefit($id, $data);
            if ($benefit->exists)
            {
                return Redirect::to('admin/benefits/' . $benefit->id);
            }
        }
    }

    public function disableToggle($id)
    {
        Benefit::disableBenefitToggle($id);
        return Redirect::to('admin/benefits');
    }
} 