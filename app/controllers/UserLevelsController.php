<?php

class UserLevelsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $levels = UserLevel::getLevels();
        if ($levels)
        {
            $this->setApiResponse($levels->toArray(), true);
        }
        return Response::json($this->api_response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $level = UserLevel::getLevel($id);
        if ($level)
        {
            $this->setApiResponse($level->toArray(), true);
        }
        return Response::json($this->api_response);
    }

}