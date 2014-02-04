<?php
class SocialGallery extends BaseModel {

    protected $table = 'galerias_sociales';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $rules = array(
        'imagen_web' => 'required',
        'fecha' => 'required',
        'nombre' => 'required'
    );

    public function images()
    {
        return $this->hasMany('GalleryImage', 'galeria_id');
    }

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$rules[$ignored_field]);
            }
        }
        $validator = Validator::make($input, self::$rules);
        return $validator;
    }

    static public function getGallery($id)
    {
        if ($id)
        {
            $gallery = self::with('images')->find($id);
            if ($gallery && $gallery->exists)
            {
                return $gallery;
            }
        }
        return false;
    }
    
    static public function getGalleries()
    {
        return self::with('images')->get()->each(function($gallery)
        {
            $gallery->prepareForWS();
            if (!empty($gallery->images))
            {
                foreach ($gallery->images as $image)
                {
                    $image->prepareForWS();
                }
            }
        });
    }

    static public function createGallery($data)
    {
        $gallery = new SocialGallery();
        $gallery->nombre = $data['nombre'];
        $gallery->fecha = $data['fecha'];

        $gallery = self::uploadImages($gallery, $data);


        if ($gallery->save())
        {
	        $gallery = self::uploadGalleryImages($gallery, $data);
        }
        return $gallery;
    }

    static public function updateGallery($id, $data)
    {
        $gallery = SocialGallery::find($id);
	    $gallery->nombre = $data['nombre'];
	    $gallery->fecha = $data['fecha'];

        $gallery = self::uploadImages($gallery, $data);

	    if ($gallery->save())
	    {
		    return $gallery;
	    }
    }

    static public function uploadImages($gallery, $data)
    {
        $object_dir = 'social_galleries';
        $name_prefix = hash('sha1', $gallery->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

	    $image_fields = array('imagen_web');

	    foreach ($image_fields as $ifield)
	    {
		    if (isset($data[$ifield]) && ($data[$ifield] && $data[$ifield] != ''))
		    {
			    $ext = $data[$ifield]->getClientOriginalExtension();
			    if ($data[$ifield]->move($dir, $name_prefix . '_' . $ifield . '.' . $ext))
			    {
				    $gallery->$ifield = 'img/' . $object_dir . '/' . $name_prefix . '_' . $ifield . '.' . $ext;
			    }
		    }
	    }
        return $gallery;
    }

	static public function uploadGalleryImages($gallery, $data)
	{
		$object_dir = 'gallery_images';
		$name_prefix = hash('sha1', $gallery->nombre);
		$dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

		foreach ($data['imagenes'] as $k=>$new_image)
		{
			$ext = $new_image->getClientOriginalExtension();
			$hashed_name = hash('sha1', $new_image->getClientOriginalName());
			if ($new_image->move($dir, $name_prefix . '_' . $hashed_name . '.' . $ext))
			{
				$image = new GalleryImage();
				$image->imagen = 'img/' . $object_dir . '/' . $name_prefix . '_' . $hashed_name . '.' . $ext;
				$image->descripcion = $data['descripcion'][$k];
				$gallery->images()->save($image);
			}
		}

		return $gallery;
	}

    public function prepareForWS()
    {
        $this->imagen_web = asset($this->imagen_web);
    }
} 