<?php
class AdminEventsController extends AdminBaseController {
    protected $layout = 'admin_layout';
    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'events'));
        });
    }
    public function index()
    {
        $events = AppEvent::with('sub_category')->get();
        return $this->layout->content = View::make('admin_events.index')->with(array('events' => $events));
    }

    public function show($id)
    {
        $event = AppEvent::with('sub_category')->find($id);
        return $this->layout->content = View::make('admin_events.show')->with(array('event' => $event));
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
        $event_categories = EventSubCategory::all();
        $categories = array();
        foreach ($event_categories as $cat)
        {
            $categories[$cat->id] = $cat->nombre;
        }
        return $this->layout->content = View::make('admin_events.create', array('event' => $event, 'categories' => $categories));
    }

    public function store()
    {
        $data = Input::all();

        $validator = AppEvent::validate($data);

        if ($validator->fails())
        {
            return Redirect::to('admin/benefits/create')->withErrors($validator)->withInput();
        }
        else
        {
            $event = AppEvent::createEvent($data);
            if ($event->exists)
            {
                return Redirect::to('admin/events/' . $event->id);
            }
        }
    }

    public function edit($id)
    {
        $event = AppEvent::find($id);
        $event_categories = EventSubCategory::all();
        $categories = array();
        foreach ($event_categories as $cat)
        {
            $categories[$cat->id] = $cat->nombre;
        }
        return $this->layout->content = View::make('admin_events.edit', array('event' => $event, 'categories' => $categories));
    }

    public function update($id)
    {
        $data = Input::all();
        $event = AppEvent::updateEvent($id, $data);
        if ($event->validator->fails())
        {
            Session::flash('event_error', $data);
            return Redirect::to('admin/events/' . $id . '/edit')->withErrors($event->validator);
        }
        else
        {
            return Redirect::to('admin/events/' . $id);
        }
    }

    public function disableToggle($id)
    {
        AppEvent::disableEventToggle($id);
        return Redirect::to('admin/events');
    }
} 