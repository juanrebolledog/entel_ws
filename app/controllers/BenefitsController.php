<?php

class BenefitsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lat = filter_var(Input::get('lat'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $lng = filter_var(Input::get('lng'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $benefits = Benefit::findByLocation($lat, $lng);
        $response = array(
            'data' => $benefits,
            'status' => true
        );
        return Response::json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    public function vote($id)
    {
        $input = Input::all();
        $response = array('data' => array(), 'status' => false);
        $user_id = 1;
        if (BenefitVote::saveVote($id, $user_id, $input['vote']))
        {
            $response['data'] = array(
                'vote' => $input['vote'],
                'id' => $id
            );
        }
        return Response::json($response);
    }

    public function ignore($id)
    {
        $response = array('data' => array(), 'status' => false);
        $user_id = 1;
        if (BenefitIgnore::saveIgnore($id, $user_id))
        {
            $response['data'] = array(
                'id' => $id
            );
        }
        return Response::json($response);
    }

}