<?php

class BenefitSubCategoriesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sub_categories = BenefitSubCategory::with('benefits')->get();
        $this->setApiResponse($sub_categories->toArray(), true);
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
        $include = (bool)filter_var(Input::get('include'), FILTER_SANITIZE_STRING);
        if ($include)
        {
            $count = (int)filter_var(Input::get('count'), FILTER_SANITIZE_NUMBER_INT);
            $order = (string)filter_var(Input::get('order', FILTER_SANITIZE_STRING));
            if ($count)
            {

            }
        }
        $sub_category = BenefitSubCategory::with('benefits')->find($id);
        $this->setApiResponse($sub_category->toArray(), true);
        return Response::json($this->api_response);
    }

}