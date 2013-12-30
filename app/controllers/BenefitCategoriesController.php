<?php

class BenefitCategoriesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = BenefitCategory::getCategories();
        if ($categories)
        {
            $this->setApiResponse($categories->toArray(), true);
        }
        else
        {
            $this->setApiResponse(false, false);
        }

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
        $category = BenefitCategory::getCategory($id);
        if ($category)
        {
            $this->setApiResponse($category->toArray(), true);
        }
        else
        {
            $this->setApiResponse(false, false, 'No encontrado');
        }

        return Response::json($this->api_response);
    }

}