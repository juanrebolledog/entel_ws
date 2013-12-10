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
        $sub_category = BenefitSubCategory::with('benefits')->find($id);
        $this->setApiResponse($sub_category->toArray(), true);
        return Response::json($this->api_response);
    }

}