<?php
class BenefitCategory extends BaseModel {
    protected $table = 'categorias_beneficios';

    public $timestamps = false;

    static public $validation = array(
        'nombre' => 'required',
        'banner' => 'required',
        'banner_link' => 'required',
        'icono' => 'required'
    );

    public function sub_categories()
    {
        return $this->hasMany('BenefitSubCategory', 'categoria_id');
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

    static public function getCategory($id)
    {
        $category = self::find($id);
        if ($category)
        {
            $category->banner = asset($category->banner);
            $category->icono = asset($category->icono);

            $sub_categories = BenefitSubCategory::getSubCategories($id);
            $category->sub_categories = $sub_categories->toArray();
            return $category;
        }
        return false;
    }

    static public function createCategory($data)
    {
        $category = new BenefitCategory();
        $category->nombre = $data['nombre'];
        $category->banner_link = $data['banner_link'];

        $category = self::uploadImages($category, $data);

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = BenefitCategory::find($id);
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
        $object_dir = 'benefit_categories';
        $name_prefix = hash('sha1', $category->nombre . ' - ' . $category->banner_link);
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

    public function prepareForWS()
    {
        $this->banner = asset($this->banner);
        $this->icono = asset($this->icono);
    }
} 