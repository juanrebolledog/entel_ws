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
	            $category->prepareForWS();
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
		        $cat->prepareForWS();
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

	    $category = self::uploadImages($category, $data);

        $category->save();
        return $category;
    }

    static public function updateCategory($id, $data)
    {
        $category = ZoneCategory::find($id);
        $category->nombre = $data['nombre'];

	    $category = self::uploadImages($category, $data);

	    $category->save();
	    return $category;
    }

	static public function uploadImages($scategory, $data)
	{
		$object_dir = 'zone_categories';
		$name_prefix = hash('sha1', $scategory->nombre);
		$dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';
		$image_fields = array('imagen_fondo');

		foreach ($image_fields as $ifield)
		{
			if (isset($data[$ifield]) && ($data[$ifield] && $data[$ifield] != ''))
			{
				$ext = $data[$ifield]->getClientOriginalExtension();
				if ($data[$ifield]->move($dir, $name_prefix . '_' . $ifield . '.' . $ext))
				{
					$scategory->$ifield = 'img/' . $object_dir . '/' . $name_prefix . '_' . $ifield . '.' . $ext;
				}
			}
		}

		return $scategory;
	}

	public function prepareForWS()
	{
		$this->imagen_fondo = asset($this->imagen_fondo);
		return $this;
	}
}