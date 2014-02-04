<?php

class AdminContestsController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'contests'));
        });
    }

    public function index()
    {
        $contests = Contest::getContests();
        return $this->layout->content = View::make('admin_contests.index')->with(array('contests' => $contests));
    }

    public function show($id)
    {
        $contest = Contest::getContest($id);
        return $this->layout->content = View::make('admin_contests.show')->with(array('contest' => $contest));
    }

    public function create()
    {
        $contest = new Contest();
        return $this->layout->content = View::make('admin_contests.create', array('contest' => $contest));
    }

    public function store()
    {
        $data = Input::all();

        $validator = Contest::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('AdminContestsController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $contest = Contest::createContest($data);
            if ($contest->exists)
            {
                return Redirect::to(action('AdminContestsController@show', $contest->id));
            }
        }
    }

    public function edit($id)
    {
        $contest = Contest::with('winners')->find($id);
        return $this->layout->content = View::make('admin_contests.edit', array('contest' => $contest));
    }

    public function update($id)
    {
        $data = Input::all();

        $validator = Contest::validate($data, array('except' => array('imagen_banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminContestsController@edit', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $contest = Contest::updateContest($id, $data);
            if ($contest->exists)
            {
                return Redirect::to(action('AdminContestsController@show', $contest->id));
            }
        }
    }

    public function delete($id)
    {

    }

}