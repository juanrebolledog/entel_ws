<?php
class ZoneCategory extends BaseModel {

    protected $table = 'puntos_zonas_categorias';

    public $timestamps = false;

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $validation = array(
        'nombre' => 'required'
    );

    public function sub_categories()
    {
        return $this->hasMany('ZoneSubCategory', 'padre_id');
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
        if ($id)
        {
            $category = self::with('sub_categories')->find($id);
            if ($category && $category->exists)
            {
                return $category;
            }
        }
        return false;
    }
    
    static public function getCategories()
    {
        return self::with(array('sub_categories' => function($query)
            {
                $query->with('zones');
            }))->get()->each(function($cat)
	        {
		        $cat->sub_categories->each(function($sub_cat)
		        {
			        $sub_cat->prepareForWS();
			        $sub_cat->zones->each(function($zone)
			        {
				        $zone->prepareForWS();
			        });
		        });
	        });
    }

    static public function createCategory($data)
    {
        $category = new ZoneCategory();
        $category->nombre = $data['nombre'];

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = ZoneCategory::find($id);
        $category->nombre = $data['nombre'];

	    $category->save();
	    return $category;
    }
} 