<?php

class AdminSummerCategoriesController extends AdminBaseController {

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			View::share('data', array('current' => 'summer_categories'));
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = SummerCategory::getCategories();
		return $this->layout->content = View::make('admin_summer_categories.index')->with(array('categories' => $categories));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category = new SummerCategory();
		return $this->layout->content = View::make('admin_summer_categories.create')->with(array('category' => $category));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$validator = SummerCategory::validate($data);

		if ($validator->fails())
		{
			return Redirect::to(action('AdminSummerCategoriesController@create'))->withErrors($validator)->withInput();
		}
		else
		{
			$category = SummerCategory::createCategory($data);
			if ($category->exists)
			{
				return Redirect::to(action('AdminSummerCategoriesController@show', $category->id));
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
		$category = SummerCategory::getCategory($id);
		return $this->layout->content = View::make('admin_summer_categories.show')->with(array('category' => $category));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = SummerCategory::getCategory($id);
		return $this->layout->content = View::make('admin_summer_categories.edit')->with(array('category' => $category));
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

		$validator = SummerCategory::validate($data, array('except' => array('imagen_fondo')));

		if ($validator->fails())
		{
			return Redirect::to(action('AdminSummerCategoriesController@update', $id))->withErrors($validator)->withInput();
		}
		else
		{
			$category = SummerCategory::updateCategory($id, $data);
			if ($category->exists)
			{
				return Redirect::to(action('AdminSummerCategoriesController@show', $category->id));
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