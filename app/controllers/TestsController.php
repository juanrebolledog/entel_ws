<?php

class TestsController extends \BaseController {

    public function get()
    {
        $input = Input::all();
        $headers = Request::header();
        return Response::json(array(
            'input' => $input,
            'headers' => $headers
        ));
    }

    public function post()
    {
        $input = Input::all();
        $headers = Request::header();
        return Response::json(array(
            'input' => $input,
            'headers' => $headers
        ));
    }

}