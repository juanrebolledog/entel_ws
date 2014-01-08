<?php
class GalleryImage extends BaseModel {

    protected $table = 'galerias_imagenes';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $validation = array(
        'descripcion' => 'required',
        'imagen' => 'required'
    );

    public function gallery()
    {
        return $this->belongsTo('SocialGallery', 'galeria_id');
    }

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$validation[$ignored_field]);
            }
        }
        $validator = Validator::make($input, self::$validation);
        return $validator;
    }

    static public function getImage($id)
    {
        if ($id)
        {
            $image = self::with('gallery')->find($id);
            if ($image && $image->exists)
            {
                return $image;
            }
        }
        return false;
    }
    
    static public function getImages()
    {
        return self::with('gallery')->get()->each(function($image)
        {
            $image->prepareForWS();
        });
    }

    static public function createImage($data)
    {
        $image = new Image();
        $image->descripcion = $data['descripcion'];

        $image = self::uploadImages($image, $data);

        $image->save();
        return $image;
    }

    static public function updateImage($id, $data)
    {
        $image = Image::find($id);
        $image->descripcion = $data['descripcion'];

        $image = self::uploadImages($image, $data);

        $image_array = $image->toArray();
        $image_validator = Validator::make($image_array, self::$validation);
        if ($image_validator->fails())
        {
            return $image;
        }
        else
        {
            if ($image->save())
            {
                $image->validator = $image_validator;
                return $image;
            }
        }
    }

    static public function uploadImages($image, $data)
    {
        $object_dir = 'gallery_images';
        $name_prefix = hash('sha1', $image->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['imagen'])
        {
            $ext = $data['imagen']->getClientOriginalExtension();
            if ($data['imagen']->move($dir, $name_prefix . '_imagen.' . $ext))
            {
                $image->imagen = 'img/' . $object_dir . '/' . $name_prefix . '_imagen.' . $ext;
            }
        }

        return $image;
    }

    public function prepareForWS()
    {
        $this->imagen = asset($this->imagen);
    }
} 