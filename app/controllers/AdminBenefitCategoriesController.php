<?php

class AdminBenefitCategoriesController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'benefit_categories'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = BenefitCategory::with('sub_categories')->get();
        return $this->layout->content = View::make('admin_benefit_categories.index')->with(array('categories' => $categories));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = BenefitCategory::with('sub_categories')->find($id);
        return $this->layout->content = View::make('admin_benefit_categories.show')->with(array('category' => $category));
    }

    public function create()
    {
        $category = new BenefitCategory();
        return $this->layout->content = View::make('admin_benefit_categories.create', array('category' => $category));
    }

    public function store()
    {
        $data = Input::all();

        $validator = BenefitCategory::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitCategoriesController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $category = BenefitCategory::createCategory($data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminBenefitCategoriesController@show', $category->id));
            }
        }
    }

    public function edit($id)
    {
        $category = BenefitCategory::find($id);
        return $this->layout->content = View::make('admin_benefit_categories.edit', array('category' => $category));
    }

    public function update($id)
    {
        $data = Input::all();

        $validator = BenefitCategory::validate($data, array('except' => array('banner', 'icono')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitCategoriesController@edit', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $category = BenefitCategory::updateCategory($id, $data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminBenefitCategoriesController@show', $category->id));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}