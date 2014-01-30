<?php
class ZoneSubCategory extends BaseModel {

    protected $table = 'puntos_zonas_sub_categorias';

    public $timestamps = false;

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $validation = array(
        'nombre' => 'required',
        'imagen_icono' => 'required'
    );

    public function zones()
    {
        return $this->hasMany('Zone', 'categoria_id');
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
            $category = self::with('zones')->find($id);
            if ($category && $category->exists)
            {
                return $category;
            }
        }
        return false;
    }

    static public function getCategories()
    {
        return self::with('zones')->get();
    }

    static public function createCategory($data)
    {
        $scategory = new ZoneSubCategory();
        $scategory->nombre = $data['nombre'];
	    $scategory->padre_id = $data['padre_id'];

        $scategory = self::uploadImages($scategory, $data);

        $scategory->save();
        return $scategory;
    }

    static public function updateCategory($id, $data)
    {
        $scategory = ZoneSubCategory::find($id);
        $scategory->nombre = $data['nombre'];
	    $scategory->padre_id = $data['padre_id'];

        $scategory = self::uploadImages($scategory, $data);

	    $scategory->save();

        return $scategory;
    }

    static public function uploadImages($scategory, $data)
    {
        $object_dir = 'zone_sub_categories';
        $name_prefix = hash('sha1', $scategory->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';
	    $image_fields = array('imagen_icono');

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
	    $this->imagen_icono = asset($this->imagen_icono);
	    return $this;
    }
} 