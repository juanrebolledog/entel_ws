<?php
class Zone extends BaseModel {

    protected $table = 'puntos_zonas';

    public $timestamps = false;

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $validation = array(
        'nombre' => 'required',
        'url' => 'required',
        'imagen' => 'required'
    );

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
    
    static public function getZone($id = null)
    {
        if ($id)
        {
            $zone = self::find($id);
            if ($zone && $zone->exists)
            {
                $zone->imagen = asset($zone->imagen);
                return $zone;
            }
        }
        else
        {
            $zones = self::all();
            foreach ($zones as $zone)
            {
                $zone->prepareForWS();
            }
            return $zones;
        }
        return false;
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
        return $zone;
    }

    public function prepareForWS()
    {
        $this->imagen = asset($this->imagen);
    }
} 