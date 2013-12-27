<?php

class BenefitSubCategory extends BaseModel {

    protected $table = 'sub_categorias_beneficios';

    public $timestamps = false;

    static public $validation = array(
        'nombre' => 'required',
        'banner' => 'required',
        'banner_link' => 'required',
        'categoria_id' => 'required'
    );

    public function benefits()
    {
        return $this->hasMany('Benefit', 'sub_categoria_id');
    }

    public function category()
    {
        return $this->belongsTo('BenefitCategory', 'categoria_id');
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

    static public function getSubCategory($id = null)
    {
        $category_query = self::with('category', 'benefits');
        if ($id)
        {
            $category = $category_query->find($id);
        }
        else
        {
            $category = $category_query->get();
        }
        if ($category)
        {
            $category->banner = asset($category->banner);
            $category->icono = asset($category->icono);
            return $category;
        }
        return false;
    }

    static public function getSubCategories($category_id = null)
    {
        $category_query = self::with('benefits');
        if ($category_id)
        {
            $categories = $category_query->where('categoria_id', $category_id)->get();
        }
        else
        {
            $categories = $category_query->get();
        }
        if ($categories)
        {
            foreach ($categories as $scat)
            {
                $scat->prepareForWS();
            }
        }
        return $categories;
    }

    static public function createCategory($data)
    {
        $category = new BenefitSubCategory();
        $category->nombre = $data['nombre'];
        $category->banner_link = $data['banner_link'];
        $category->categoria_id = $data['categoria_id'];

        $category = self::uploadImages($category, $data);

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = BenefitSubCategory::find($id);
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
        $object_dir = 'benefit_sub_categories';
        $name_prefix = hash('sha1', $category->nombre . ' - ' . $category->banner_link);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

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

    public function prepareForWS()
    {
        $this->banner = asset($this->banner);
        $this->icono = asset($this->icono);
        if (isset($this->benefits))
        {
            foreach ($this->benefits as $benefit)
            {
                $benefit->prepareForWS();
            }
        }
    }
} 