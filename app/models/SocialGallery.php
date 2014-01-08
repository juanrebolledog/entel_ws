<?php
class SocialGallery extends BaseModel {

    protected $table = 'galerias_sociales';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $rules = array(
        'imagen' => 'required',
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
        $gallery = new Gallery();
        $gallery->nombre = $data['nombre'];
        $gallery->url = $data['url'];

        $gallery = self::uploadImages($gallery, $data);

        $gallery->save();
        return $gallery;
    }

    static public function updateGallery($id, $data)
    {
        $gallery = Gallery::find($id);
        $gallery->nombre = $data['nombre'];
        $gallery->url = $data['url'];

        $gallery = self::uploadImages($gallery, $data);

        $gallery_array = $gallery->toArray();
        $gallery_validator = Validator::make($gallery_array, self::$validation);
        if ($gallery_validator->fails())
        {
            return $gallery;
        }
        else
        {
            if ($gallery->save())
            {
                $gallery->validator = $gallery_validator;
                return $gallery;
            }
        }
    }

    static public function uploadImages($gallery, $data)
    {
        $object_dir = 'social_galleries';
        $name_prefix = hash('sha1', $gallery->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['imagen'])
        {
            $ext = $data['imagen']->getClientOriginalExtension();
            if ($data['imagen']->move($dir, $name_prefix . '_imagen.' . $ext))
            {
                $gallery->galleryn = 'img/' . $object_dir . '/' . $name_prefix . '_imagen.' . $ext;
            }
        }
        return $gallery;
    }

    public function prepareForWS()
    {
        $this->imagen_web = asset($this->imagen_web);
    }
} 