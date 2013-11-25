<?php
class AdminBenefitsController extends BaseController {
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
        if (Session::get('benefit_error'))
        {
            Eloquent::unguard();
            $benefit = new Benefit(Session::get('benefit_error'));
        }
        else
        {
            $benefit = new Benefit();
        }
        return $this->layout->content = View::make('admin_benefits.create', array('benefit' => $benefit));
    }

    public function store()
    {
        $data = Input::all();
        $benefit = Benefit::createBenefit($data);
        if ($benefit->validator->fails())
        {
            Session::flash('benefit_error', $data);
            return Redirect::to('admin/benefits/create')->withErrors($benefit->validator);
        }
        else
        {
            return Redirect::to('admin/benefits/' . $benefit->id);
        }
    }

    public function edit($id)
    {
        $benefit = Benefit::find($id);
        return $this->layout->content = View::make('admin_benefits.edit', array('benefit' => $benefit));
    }

    public function update($id)
    {
        $data = Input::all();
        $benefit = Benefit::updateBenefit($id, $data);
        if ($benefit->validator->fails())
        {
            Session::flash('benefit_error', $data);
            return Redirect::to('admin/benefits/' . $id . '/edit')->withErrors($benefit->validator);
        }
        else
        {
            return Redirect::to('admin/benefits/' . $id);
        }
    }

    public function disableToggle($id)
    {
        Benefit::disableBenefitToggle($id);
        return Redirect::to('admin/benefits');
    }
} 