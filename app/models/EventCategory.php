<?php
class EventCategory extends BaseModel {
    protected $table = 'categorias_eventos';

    public $timestamps = false;

    static public $validation = array(
        'nombre' => 'required',
        'banner' => 'required'
    );

    public function sub_categories()
    {
        return $this->hasMany('EventSubCategory', 'categoria_id');
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

    static public function getCategory()
    {
        $category = self::with('sub_categories')->first();
        return $category;
    }

    static public function getSubCategory($sub_category_id)
    {
        $sub_category = EventSubCategory::getSubCategory($sub_category_id);
        return $sub_category;
    }

    public function prepareForWS()
    {
        $this->banner = asset($this->banner);
        $this->icono = asset($this->icono);
    }

    static public function createCategory($data)
    {
        $category = new self();
        $category->nombre = $data['nombre'];
        $category->banner_link = $data['banner_link'];

        $category = self::uploadImages($category, $data);

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = self::find($id);
        $category->nombre = $data['nombre'];
        $category->banner_link = $data['banner_link'];

        $category = self::uploadImages($category, $data);

        $category_array = $category->toArray();
        $category_validator = Validator::make($category_array, self::$validation);
        if ($category_validator->fails())
        {
            return $category;
        }
        else
        {
            if ($category->save())
            {
                $category->validator = $category_validator;
                return $category;
            }
        }
    }

    static public function uploadImages($category, $data)
    {
        $object_dir = 'event_sub_categories';
        $name_prefix = hash('sha1', $category->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['icono'])
        {
            $ext = $data['icono']->getClientOriginalExtension();
            if ($data['icono']->move($dir, $name_prefix . '_icono.' . $ext))
            {
                $category->icono = 'img/' . $object_dir . '/' . $name_prefix . '_icono.' . $ext;
            }
        }

        if ($data['banner'])
        {
            $ext = $data['banner']->getClientOriginalExtension();
            if ($data['banner']->move($dir, $name_prefix . '_banner.' . $ext))
            {
                $category->banner = 'img/' . $object_dir . '/' . $name_prefix . '_banner.' . $ext;
            }
        }

        return $category;
    }
} 