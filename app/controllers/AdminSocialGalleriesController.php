<?php

class AdminSocialGalleriesController extends AdminBaseController {

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'galleries'));
        });
    }

    public function index()
    {
        $social_galleries = SocialGallery::getGalleries();
        return $this->layout->content = View::make('admin_social_galleries.index')->with(array('social_galleries' => $social_galleries));
    }

    public function show($id)
    {
        $social_gallery = SocialGallery::getGallery($id);
        return $this->layout->content = View::make('admin_social_galleries.show')->with(array('social_gallery' => $social_gallery));
    }

    public function create()
    {
        $social_gallery = new SocialGallery();
        return $this->layout->content = View::make('admin_social_galleries.create', array('social_gallery' => $social_gallery));
    }

    public function store()
    {
        $data = Input::all();

        $validator = SocialGallery::validate($data);

        if ($validator->fails())
        {
            return Redirect::to(action('AdminSocialGalleriesController@create'))->withErrors($validator)->withInput();
        }
        else
        {
            $social_gallery = SocialGallery::createGallery($data);
            if ($social_gallery->exists)
            {
                return Redirect::to(action('AdminSocialGalleriesController@show', $social_gallery->id));
            }
        }
    }

    public function edit($id)
    {
        $social_gallery = SocialGallery::with('images')->find($id);
        return $this->layout->content = View::make('admin_social_galleries.edit', array('social_gallery' => $social_gallery));
    }

    public function update($id)
    {
        $data = Input::all();

        $zone_validator = SocialGallery::validate($data, array('except' => array('imagen', 'imagen_web')));

        if ($zone_validator->fails())
        {
            return Redirect::to(action('AdminSocialGallerysController@edit', $id))->withErrors($zone_validator)->withInput();
        }
        else
        {
            $zone = SocialGallery::updateSocialGallery($id, $data);
            if ($zone->exists)
            {
                return Redirect::to(action('AdminSocialGallerysController@show', $zone->id));
            }
        }
    }

    public function delete($id)
    {

    }

	public function images($id)
	{

	}

}