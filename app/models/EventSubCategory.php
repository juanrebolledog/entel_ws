<?php
class EventSubCategory extends BaseModel {
    protected $table = 'sub_categorias_eventos';
    public $timestamps = false;

    static public $validation = array(
        'nombre' => 'required',
        'banner' => 'required'
    );

    public function events()
    {
        return $this->hasMany('AppEvent', 'sub_categoria_id');
    }

    static public function getSubCategory($id)
    {
        $sub_category = self::with('events')->find($id);
        return $sub_category;
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

    public function prepareForWS()
    {
        $this->banner = asset($this->banner);
        $this->icono = asset($this->icono);
    }

    static public function getSubCategories()
    {
        $sub_categories = self::with(array('events' => function($query)
            {
                $query->with('images');
                $query->with('prices');
                $query->with('discounts');
                $query->with('videos');
	            $query->with('dates');
	            $query->with('locations');
            }))->get()->each(function($sub_cat)
        {
            $sub_cat->prepareForWS();
            foreach ($sub_cat->events as $event)
            {
                $event->prepareForWS();
                if (!empty($event->images))
                {
                    foreach ($event->images as $img)
                    {
                        $img->prepareForWS();
                    }
                }
            }
        });
        return $sub_categories;
    }

    static public function createSubCategory($data)
    {
        $sub_category = new self();
        $sub_category->nombre = $data['nombre'];
        $sub_category->banner_link = $data['banner_link'];
        $sub_category->categoria_id = EventCategory::getCategory()->id;

        $sub_category = self::uploadImages($sub_category, $data);

        $sub_category->save();
        return $sub_category;
    }

    static public function updateSubCategory($id, $data)
    {
        $sub_category = self::find($id);
        $sub_category->nombre = $data['nombre'];
        $sub_category->banner_link = $data['banner_link'];

        $sub_category = self::uploadImages($sub_category, $data);

        $sub_category_array = $sub_category->toArray();
        $sub_category_validator = Validator::make($sub_category_array, self::$validation);
        if ($sub_category_validator->fails())
        {
            return $sub_category;
        }
        else
        {
            if ($sub_category->save())
            {
                $sub_category->validator = $sub_category_validator;
                return $sub_category;
            }
        }
    }

    static public function uploadImages($sub_category, $data)
    {
        $object_dir = 'event_sub_categories';
        $name_prefix = hash('sha1', $sub_category->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['banner'])
        {
            $ext = $data['banner']->getClientOriginalExtension();
            if ($data['banner']->move($dir, $name_prefix . '_banner.' . $ext))
            {
                $sub_category->banner = 'img/' . $object_dir . '/' . $name_prefix . '_banner.' . $ext;
            }
        }

        return $sub_category;
    }
} 