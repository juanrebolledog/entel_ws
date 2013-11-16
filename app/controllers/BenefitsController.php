<?php

class BenefitsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lat = (float)filter_var(Input::get('lat'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $lng = (float)filter_var(Input::get('lng'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if (is_float($lat) && is_float($lng)) {
            $benefits = Benefit::findByLocation($lat, $lng);
        } else {
            $benefits = Benefit::all();
            $benefits = $benefits->toArray();
        }
        $response = array(
            'data' => $benefits,
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

    public function vote($id)
    {
        $input = Input::all();
        $response = array('data' => array(), 'status' => false);
        $user_id = Auth::getUser()->id;
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
                'id' => $id,
            );
            $response['status'] = true;
        }
        return Response::json($response);
    }

    public function search()
    {
        $q = filter_var(Input::get('q'), FILTER_SANITIZE_STRING);
        $benefits = Benefit::where('description', 'LIKE', '%' . $q . '%')->get();
        $response = array('data' => $benefits->toArray(), 'status' => true);
        return Response::make($response);
    }

}