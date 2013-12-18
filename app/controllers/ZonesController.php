<?php

class ZonesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $zones = Zone::getZone();
        $this->setApiResponse($zones->toArray(), true);
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
        $zone = Zone::getZone($id);
        if ($zone)
        {
            $this->setApiResponse($zone->toArray(), true);
        }
        else
        {
            $this->setApiResponse(array(), false, 'Not Found');
        }
        return Response::json($this->api_response);
    }

}