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
        $response = array(
            'data' => $categories->toArray(),
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
        $category = Category::find($id);
        return Response::json(array('data' => $category->toArray(), 'status' => true));
    }
} 