<?php

class CategoriesController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        $this->setApiResponse($categories->toArray(), true);
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
        $category = Category::find($id);
        $this->setApiResponse($category->toArray(), true);
        return Response::json($this->api_response);
    }
} 