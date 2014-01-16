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
        $limit = (int)filter_var(Input::get('limit'), FILTER_SANITIZE_NUMBER_INT);
        $range = (float)filter_var(Input::get('range'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $user_id = Auth::getUser()->id;
        if ($lat && $lng) {
            $benefits = Benefit::findByLocation($lat, $lng, $user_id, $range, $limit);
        } else {
            $benefits = Benefit::getBenefits($user_id);
        }
        $this->setApiResponse($benefits->toArray(), true);
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
        $benefit = Benefit::getBenefit($id);
        if ($benefit)
        {
            $this->setApiResponse($benefit->toArray(), true);
        }
        else
        {
            $this->setApiResponse(array(), false, 'Not Found');
        }
        return Response::json($this->api_response);
    }

    public function vote($id)
    {
        $input = Input::all();
        $user_id = Auth::getUser()->id;
        if (!empty($input) && isset($input['vote']) && is_numeric($input['vote']))
        {
            $vote = BenefitVote::saveVote($id, $user_id, $input['vote']);
            if ($vote)
            {
                $resp = array(
                    'vote' => $vote->votacion,
                    'id' => $vote->id
                );
                $this->setApiResponse($resp, true);
            }
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

    public function redeem($id)
    {
        $user_id = Auth::getUser()->id;
        $data = Input::all();
        if ($data && !empty($data))
        {
            if ( (isset($data['lat']) && is_numeric($data['lat'])) && (isset($data['lng']) && is_numeric($data['lng'])) )
            {
                if (BenefitRedeem::redeem($id, $user_id, $data['lat'], $data['lng']))
                {
                    $this->setApiResponse(array(
                        'id' => $id,
                        'redeemed' => true
                    ), true);
                }
            }
            else
            {
                $this->setApiResponse(false, false, 'Faltan los datos de ubicación: `lat` y `lng`');
            }
        }
        return Response::json($this->api_response);
    }

}