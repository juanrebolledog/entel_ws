<?php
class BenefitImage extends BaseModel {

    protected $table = 'beneficios_imagenes';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $rules = array(
        'imagen' => 'required',
        'descripcion' => 'required'
    );

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
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

    static public function getImage($id)
    {
        if ($id)
        {
            $image = self::with('benefits')->find($id);
            if ($image && $image->exists)
            {
                return $image->prepareForWS();
            }
        }
        return false;
    }

    static public function getImages()
    {
        return self::with('benefits')->get()->each(function($image)
        {
            $image->prepareForWS();
        });
    }

    static public function createImage($data)
    {
        $image = new self();
        $image->descripcion = $data['descripcion'];

        $image = self::uploadImages($image, $data);

        $image->save();
        return $image;
    }

    static public function updateImage($id, $data)
    {
        $image = self::find($id);
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
        $object_dir = 'benefit_images';
        $name_prefix = hash('sha1', $image->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['image'])
        {
            $ext = $data['image']->getClientOriginalExtension();
            if ($data['image']->move($dir, $name_prefix . '_image.' . $ext))
            {
                $image->image = 'img/' . $object_dir . '/' . $name_prefix . '_image.' . $ext;
            }
        }

        return $image;
    }

    public function prepareForWS()
    {
        $this->imagen = asset($this->imagen);
        return $this;
    }
} 