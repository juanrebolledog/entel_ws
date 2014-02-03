<?php
class SummerCategory extends BaseModel {

    protected $table = 'veranos_categorias';

    public $timestamps = false;

    static public $rules = array(
        'nombre' => 'required'
    );

    public function summers()
    {
        return $this->hasMany('Summer', 'categoria_id');
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

    static public function getCategory($id)
    {
        if ($id)
        {
            $category = self::with('summers')->find($id);
            if ($category && $category->exists)
            {
                $category->summers->each(function($summer)
                {
                    $summer->prepareForWS();
                });
                return $category;
            }
        }
        return false;
    }

    static public function getCategories()
    {
        return self::with('summers')->get()->each(function($category)
        {
            $category->summers->each(function($summer)
            {
                $summer->prepareForWS();
            });
        });
    }

    static public function createCategory($data)
    {
        $category = new self();
        $category->nombre = $data['nombre'];

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = self::find($id);
        $category->nombre = $data['nombre'];

        $category_array = $category->toArray();
        $category_validator = Validator::make($category_array, self::$rules);
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
} 