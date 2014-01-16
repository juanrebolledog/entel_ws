<?php
class Zone extends BaseModel {

    public function __construct()
    {
        Validator::extend('web_dimensions', function($attribute, $value, $parameters)
        {
            $size = getimagesize($value);
            return $size[0] <= 300 && $size[1] <= 100;
        });

        Validator::extend('ws_dimensions', function($attribute, $value, $parameters)
        {
            $size = getimagesize($value);
            return $size[0] <= 300 && $size[1] <= 100;
        });

        parent::__construct();
    }

    protected $table = 'puntos_zonas';

    public $timestamps = false;

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $validation = array(
        'nombre' => 'required',
        'url' => 'required',
        'imagen' => 'required',
        'imagen_web' => 'required'
    );

    public function category()
    {
        return $this->belongsTo('ZoneSubCategory', 'categoria_id');
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

    static public function getZone($id)
    {
        if ($id)
        {
            $zone = self::with('category')->find($id);
            if ($zone && $zone->exists)
            {
                $zone->prepareForWS();
                return $zone;
            }
        }
        return false;
    }
    
    static public function getZones()
    {

        $zones = self::with('category')->get();
        foreach ($zones as $zone)
        {
            $zone->prepareForWS();
        }
        return $zones;
    }

    static public function createZone($data)
    {
        $zone = new Zone();
        $zone->nombre = $data['nombre'];
        $zone->url = $data['url'];
        $zone->categoria_id = $data['categoria_id'];

        $zone = self::uploadImages($zone, $data);

        $zone->save();
        return $zone;
    }

    static public function updateZone($id, $data)
    {
        $zone = Zone::find($id);
        $zone->nombre = $data['nombre'];
        $zone->url = $data['url'];
        $zone->categoria_id = $data['categoria_id'];

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
    }

    static public function random($num = 1)
    {
	    $db = Config::get('database.default');
	    if ($db == 'sqlite')
	    {
		    $random_string = 'RANDOM()';
	    }
	    else
	    {
		    $random_string = 'RAND()';
	    }
        return self::orderBy(DB::raw($random_string))->take($num)->get()->each(function($obj)
        {
            $obj->prepareForWS();
        });
    }
} 