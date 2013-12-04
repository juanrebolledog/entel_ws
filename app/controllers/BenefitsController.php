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
        $user_id = Auth::getUser()->id;
        if (is_float($lat) && is_float($lng)) {
            $benefits = Benefit::findByLocation($user_id, $lat, $lng);
        } else {
            $benefits = Benefit::all();
            $benefits = $benefits->toArray();
        }
        $this->setApiResponse($benefits, true);
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
        $benefit = Benefit::find($id);
        $this->setApiResponse($benefit->toArray(), true);
        return Response::json($this->api_response);
    }

    public function vote($id)
    {
        $input = Input::all();
        $user_id = Auth::getUser()->id;
        if (BenefitVote::saveVote($id, $user_id, $input['vote']))
        {
            $resp = array(
                'vote' => $input['vote'],
                'id' => $id
            );
            $this->setApiResponse($resp, true);
        }
        return Response::json($this->api_response);
    }

    public function ignore($id)
    {
        $user_id = Auth::getUser()->id;
        if (BenefitIgnore::saveIgnore($id, $user_id))
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
        $results = Benefit::searchByKeyword($q);
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

    public function ranking()
    {
        $benefits = Benefit::findByRating();
        if ($benefits)
        {
            $this->setApiResponse($benefits, true);
        }
        return Response::json($this->api_response);
    }

}