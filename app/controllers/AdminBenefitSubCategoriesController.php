<?php
class AdminBenefitSubCategoriesController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'benefit_sub_categories'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sub_categories = BenefitSubCategory::with('category', 'benefits')->get();
        return $this->layout->content = View::make('admin_benefit_sub_categories.index')->with(array('sub_categories' => $sub_categories));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $sub_category = BenefitSubCategory::with('category', 'benefits')->find($id);
        return $this->layout->content = View::make('admin_benefit_sub_categories.show')->with(array('sub_category' => $sub_category));
    }

    public function create()
    {
        $category = new BenefitSubCategory();
        $parent_categories = BenefitCategory::lists('nombre', 'id');
        return $this->layout->content = View::make('admin_benefit_sub_categories.create', array('category' => $category, 'categories' => $parent_categories));
    }

    public function store()
    {
        $data = Input::all();

        $validator = BenefitSubCategory::validate($data, array('except' => array('banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitSubCategoriesController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $category = BenefitSubCategory::createCategory($data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminBenefitSubCategoriesController@show', $category->id));
            }
        }
    }

    public function edit($id)
    {
        $category = BenefitSubCategory::find($id);
        $parent_categories = BenefitCategory::lists('nombre', 'id');
        return $this->layout->content = View::make('admin_benefit_sub_categories.edit', array('category' => $category, 'categories' => $parent_categories));
    }

    public function update($id)
    {
        $data = Input::all();

        $validator = BenefitSubCategory::validate($data, array('except' => array('banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminBenefitSubCategoriesController@edit', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $category = BenefitSubCategory::updateCategory($id, $data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminBenefitSubCategoriesController@show', $category->id));
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