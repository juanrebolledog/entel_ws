<?php

class EventsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lat = filter_input(INPUT_GET, 'lat', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $lng = filter_input(INPUT_GET, 'lng', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $events = AppEvent::findByLocation($lat, $lng);
        $this->setApiResponse($events, true);
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
        $event = AppEvent::getEvent($id);
        if ($event)
        {
            $this->setApiResponse($event->toArray(), true);
        }
        else
        {
            $this->setApiResponse(array(), false);
        }

        return Response::json($this->api_response);
    }

    public function ignore($id)
    {
        $response = array('data' => array(), 'status' => false);
        $user_id = 1;
        if (EventIgnore::saveIgnore($id, $user_id))
        {
            $resp = array(
                'id' => $id,
            );
            $this->setApiResponse($resp, true);
        }
        return Response::json($this->api_response);
    }

    public function search()
    {
        $q = filter_var(Input::get('q'), FILTER_SANITIZE_STRING);
        $results = AppEvent::searchByKeyword($q);
        if ($results)
        {
            $this->setApiResponse($results->toArray(), true);
        }
        else
        {
            $this->setApiResponse(array(), false);
        }
        return Response::make($this->api_response);
    }

}