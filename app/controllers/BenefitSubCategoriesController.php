<?php

class BenefitSubCategoriesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sub_categories = BenefitSubCategory::getSubCategories();
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
        $sub_category = BenefitSubCategory::getSubCategory($id);
        if ($include)
        {
            $count = (int)filter_var(Input::get('count'), FILTER_SANITIZE_NUMBER_INT);
            $order = (string)filter_var(Input::get('order', FILTER_SANITIZE_STRING));
        }

        $this->setApiResponse($sub_category->toArray(), true);
        return Response::json($this->api_response);
    }

}