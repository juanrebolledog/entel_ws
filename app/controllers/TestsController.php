<?php

class TestsController extends \BaseController {

    public function get()
    {
        $input = Input::all();
        return Response::json($input);
    }

    public function post()
    {
        $input = Input::all();
        return Response::json($input);
    }

}