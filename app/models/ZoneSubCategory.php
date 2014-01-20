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

    static public function createZone($data)
    {
        $zone = new Zone();
        $zone->nombre = $data['nombre'];
        $zone->url = $data['url'];

        $zone = self::uploadImages($zone, $data);

        $zone->save();
        return $zone;
    }

    static public function updateZone($id, $data)
    {
        $zone = Zone::find($id);
        $zone->nombre = $data['nombre'];
        $zone->url = $data['url'];

        $zone = self::uploadImages($zone, $data);

        $zone_array = $zone->toArray();
        $zone_validator = Validator::make($zone_array, self::$validation);
        if ($zone_validator->fails())
        {
            return $zone;
        }
        else
        {
            if ($zone->save())
            {
                $zone->validator = $zone_validator;
                return $zone;
            }
        }
    }

    static public function uploadImages($zone, $data)
    {
        $object_dir = 'zones';
        $name_prefix = hash('sha1', $zone->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['imagen'])
        {
            $ext = $data['imagen']->getClientOriginalExtension();
            if ($data['imagen']->move($dir, $name_prefix . '_imagen.' . $ext))
            {
                $zone->imagen = 'img/' . $object_dir . '/' . $name_prefix . '_imagen.' . $ext;
            }
        }

        if ($data['imagen_web'])
        {
            $ext = $data['imagen_web']->getClientOriginalExtension();
            if ($data['imagen_web']->move($dir, $name_prefix . '_imagen_web.' . $ext))
            {
                $zone->imagen_web = 'img/' . $object_dir . '/' . $name_prefix . '_imagen_web.' . $ext;
            }
        }
        return $zone;
    }

    public function prepareForWS()
    {
        $this->imagen = asset($this->imagen);
        $this->imagen_web = asset($this->imagen_web);
	    $this->imagen_icono = asset($this->imagen_icono);
    }
} 