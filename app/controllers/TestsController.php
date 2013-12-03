<?php

class TestsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'tests'));
        });
    }

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

    public function restClient()
    {
        $routes = array();
        foreach (Route::getRoutes() as $route) {
            $prefix = explode('/', $route->getPath())[1];
            if ($prefix == 'api')
            {
                array_push($routes, array(
                    'path' => $route->getPath(),
                    'methods' => $route->getMethods(),
                    'prefix' => $prefix
                ));
            }
        }

        return View::make('tests.rest_client', array('routes' => $routes));
    }

}