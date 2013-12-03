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
        if (Session::get('event_error'))
        {
            Eloquent::unguard();
            $event = new AppEvent(Session::get('event_error'));
        }
        else
        {
            $event = new AppEvent();
        }
        return $this->layout->content = View::make('admin_events.create', array('event' => $event));
    }

    public function store()
    {
        $data = Input::all();
        $event = AppEvent::createEvent($data);
        if ($event->validator->fails())
        {
            Session::flash('event_error', $data);
            return Redirect::to('admin/events/create')->withErrors($event->validator);
        }
        else
        {
            return Redirect::to('admin/events/' . $event->id);
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