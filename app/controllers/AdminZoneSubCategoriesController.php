<?php

class AdminZoneSubCategoriesController extends AdminBaseController {

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			View::share('data', array('current' => 'zone_categories'));
		});
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param $cat_id
	 * @return Response
	 */
	public function create($cat_id)
	{
		$scategory = new ZoneSubCategory();
		$categories = ZoneCategory::getCategories()->lists('nombre', 'id');
		$category = ZoneCategory::getCategory($cat_id);
		return $this->layout->content = View::make('admin_zone_sub_categories.create')->with(array('category' => $category, 'sub_category' => $scategory, 'categories' => $categories));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$data = Input::all();

		if ($data['padre_id'] == $id)
		{
			$validator = ZoneSubCategory::validate($data);

			if ($validator->fails())
			{
				return Redirect::to(action('AdminZoneSubCategoriesController@create', $id))->withErrors($validator)->withInput();
			}
			else
			{
				$category = ZoneSubCategory::createCategory($data);
				if ($category->exists)
				{
					return Redirect::to(action('AdminZoneCategoriesController@show', $id));
				}
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $scat_id)
	{
		$category = ZoneCategory::getCategory($id);
		$scategory = ZoneSubCategory::getCategory($scat_id);
		return $this->layout->content = View::make('admin_zone_sub_categories.show')->with(array('category' => $category, 'sub_category' => $scategory));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @param int $scat_id
	 * @return Response
	 */
	public function edit($id, $scat_id)
	{
		$category = ZoneCategory::getCategory($id);
		$categories = ZoneCategory::getCategories()->lists('nombre', 'id');
		$scategory = ZoneSubCategory::getCategory($scat_id);
		return $this->layout->content = View::make('admin_zone_sub_categories.edit')->with(array('category' => $category, 'sub_category' => $scategory, 'categories' => $categories));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @param int $scat_id
	 * @return Response
	 */
	public function update($id, $scat_id)
	{
		$data = Input::all();

		$validator = ZoneSubCategory::validate($data, array('except' => array('imagen_icono')));

		if ($validator->fails())
		{
			return Redirect::to(action('AdminZoneSubCategoriesController@edit', $id, $scat_id))->withErrors($validator)->withInput();
		}
		else
		{
			$category = ZoneSubCategory::updateCategory($scat_id, $data);
			if ($category->exists)
			{
				return Redirect::to(action('AdminZoneCategoriesController@show', $id));
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