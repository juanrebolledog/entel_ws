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
        $response = array(
            'data' => $events,
            'status' => true
        );
        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $benefit = Benefit::find($id);
        return Response::json(array('data' => $benefit->toArray(), 'status' => true));
    }

    public function ignore($id)
    {
        $response = array('data' => array(), 'status' => false);
        $user_id = 1;
        if (EventIgnore::saveIgnore($id, $user_id))
        {
            $response['data'] = array(
                'id' => $id,
            );
            $response['status'] = true;
        }
        return Response::json($response);
    }

}