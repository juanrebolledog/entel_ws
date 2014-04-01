<?php

class AdminEventCategoriesController extends AdminBaseController {

    protected $layout = 'admin_layout';

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'event_categories'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $category = EventCategory::getCategory();
        return $this->layout->content = View::make('admin_event_categories.index')->with(array('category' => $category));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show_sub($id)
    {
        $category = EventCategory::getCategory();
        $sub_category = EventSubCategory::getSubCategory($id);
        return $this->layout->content = View::make('admin_event_categories.show')->with(array('category' => $category, 'sub_category' => $sub_category));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create_sub()
    {
        $sub_category = new EventSubCategory();
        return $this->layout->content = View::make('admin_event_categories.create', array('sub_category' => $sub_category));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store_sub()
    {
        $data = Input::all();

        $validator = EventSubCategory::validate($data, array('except' => array('icono', 'banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminEventCategoriesController@create_sub'))->withErrors($validator)->withInput();
        }
        else
        {
            $sub_category = EventSubCategory::createSubCategory($data);
            if ($sub_category->exists)
            {
                return Redirect::to(action('AdminEventCategoriesController@show_sub', $sub_category->id));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $category = EventCategory::all()->first();
        return $this->layout->content = View::make('admin_event_categories.edit', array('category' => $category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        $data = Input::all();
        $category_unq = EventCategory::all()->first();
        $id = $category_unq->id;
        $validator = EventCategory::validate($data, array('except' => array('icono', 'banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminEventCategoriesController@edit'))->withErrors($validator)->withInput();
        }
        else
        {
            $category = EventCategory::updateCategory($id, $data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminEventCategoriesController@index'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit_sub($id)
    {
        $sub_category = EventSubCategory::find($id);
        return $this->layout->content = View::make('admin_event_categories.edit_sub', array('category' => $sub_category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update_sub($id)
    {
        $data = Input::all();

        $validator = EventSubCategory::validate($data, array('except' => array('icono', 'banner')));

        if ($validator->fails())
        {
            return Redirect::to(action('AdminEventCategoriesController@edit_sub', $id))->withErrors($validator)->withInput();
        }
        else
        {
            $category = EventSubCategory::updateSubCategory($id, $data);
            if ($category->exists)
            {
                return Redirect::to(action('AdminEventCategoriesController@index'));
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