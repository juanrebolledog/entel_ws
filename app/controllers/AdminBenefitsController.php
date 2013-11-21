<?php
class AdminBenefitsController extends BaseController {
    public $layout = 'admin_layout';
    public function index()
    {
        $benefits = Benefit::all();
        return $this->layout->nest('content', 'admin_benefits.index', array('benefits' => $benefits));
    }

    public function show($id)
    {
        $benefit = Benefit::find($id);
        return $this->layout->nest('content', 'admin_benefits.show', array('benefit' => $benefit));
    }

    public function create()
    {
        return $this->layout->nest('content', 'admin_benefits.create');
    }

    public function store()
    {

    }

    public function update($id)
    {
        $benefit = Benefit::find($id);
        return $this->layout->nest('content', 'admin_benefits.show', array('benefit' => $benefit));
    }

    public function delete($id)
    {

    }
} 