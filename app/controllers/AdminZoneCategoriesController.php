<?php

class AdminZoneCategoriesController extends AdminBaseController {

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			View::share('data', array('current' => 'zone_categories'));
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = ZoneCategory::getCategories();
		return $this->layout->content = View::make('admin_zone_categories.index')->with(array('categories' => $categories));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category = new ZoneCategory();
		return $this->layout->content = View::make('admin_zone_categories.create')->with(array('category' => $category));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$validator = ZoneCategory::validate($data);

		if ($validator->fails())
		{
			return Redirect::to(action('AdminZoneCategoriesController@create'))->withErrors($validator)->withInput();
		}
		else
		{
			$category = ZoneCategory::createCategory($data);
			if ($category->exists)
			{
				return Redirect::to(action('AdminZoneCategoriesController@show', $category->id));
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = ZoneCategory::getCategory($id);
		return $this->layout->content = View::make('admin_zone_categories.show')->with(array('category' => $category));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = ZoneCategory::getCategory($id);
		return $this->layout->content = View::make('admin_zone_categories.edit')->with(array('category' => $category));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();

		$validator = ZoneCategory::validate($data);

		if ($validator->fails())
		{
			return Redirect::to(action('AdminZoneCategoriesController@update', $id))->withErrors($validator)->withInput();
		}
		else
		{
			$category = ZoneCategory::updateCategory($id, $data);
			if ($category->exists)
			{
				return Redirect::to(action('AdminZoneCategoriesController@show', $category->id));
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