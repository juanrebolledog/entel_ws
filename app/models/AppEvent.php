<?php
class AppEvent extends LocationModel {
    protected $table = 'eventos';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static protected $validation = array(
        'nombre' => 'required',
        'descripcion' => 'required',
        'descripcion_larga' => 'required',
        'sub_categoria_id' => 'required',
        'fecha' => 'required',
        'tags' => 'required',
        'lat' => 'required',
        'lng' => 'required',
        'lugar' => 'required',
        'sms_texto' => 'required',
        'sms_nro' => 'required',
        'icono' => 'required',
        'imagen_grande' => 'required',
        'imagen_chica' => 'required',
        'imagen_titulo' => 'required',
        'imagen_ubicacion' => 'required',
        'imagen_grande_web' => 'required',
        'imagen_bg' => 'required'
    );
    
    public function sub_category()
    {
        return $this->belongsTo('EventSubCategory', 'sub_categoria_id');
    }

    public function comments()
    {
        return $this->hasMany('EventComment', 'evento_id');
    }

    public function prices()
    {
        return $this->hasMany('EventPrice', 'evento_id');
    }

    public function discounts()
    {
        return $this->hasMany('EventDiscount', 'evento_id');
    }

    public function images()
    {
        return $this->hasMany('EventImage', 'evento_id');
    }

    public function videos()
    {
        return $this->hasMany('EventVideo', 'evento_id');
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

    static public function getEvent($id)
    {
        $event = self::with('sub_category', 'comments')->find($id);
        if ($event && $event->exists)
        {
            $event->prepareForWS();
            return $event;
        }
        return false;
    }
    
    public function prepareForWS()
    {
        if ($this->exists)
        {
            $this->imagen_titulo = asset($this->imagen_titulo);
            $this->imagen_grande = asset($this->imagen_grande);
            $this->imagen_chica = asset($this->imagen_chica);
            $this->imagen_ubicacion = asset($this->imagen_ubicacion);
            $this->imagen_bg = asset($this->imagen_bg);
            $this->imagen_grande_web = asset($this->imagen_grande_web);
            $this->icono = asset($this->icono);
        }
        return true;
    }

    static public function findByLocation($lat, $lng)
    {
        $models = array();

        foreach (self::with('comments', 'sub_category')->get() as $model)
        {
            $distance = self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                array('lat' => $model->lat, 'lng' => $model->lng));
            $model->prepareForWS();
            $model = $model->toArray();
            $model['distancia'] = $distance;
            array_push($models, $model);
        }
        $models = array_values(array_sort($models, function($value)
        {
            return $value['distancia'];
        }));
        return $models;
    }

    static public function searchByKeyword($q = null)
    {
        $results = self::with('sub_category', 'comments')->where(function($query) use ($q)
        {
            $query->where('nombre', 'LIKE', '%' . $q . '%');
            $query->orWhere('descripcion', 'LIKE', '%' . $q . '%');
            $query->orWhere('tags', 'LIKE', '%' . $q . '%');
        })->get();
        return $results;
    }
    
    static public function createEvent($data)
    {
        $event = new AppEvent();
        $event->nombre = $data['nombre'];
        $event->descripcion = $data['descripcion'];
        $event->descripcion_larga = $data['descripcion_larga'];
        $event->post = $data['post'];
        $event->sub_categoria_id = $data['sub_categoria_id'];
        $event->fecha = $data['fecha'];
        $event->tags = $data['tags'];
        $event->legal = $data['legal'];

        $event->lat = $data['lat'];
        $event->lng = $data['lng'];
        $event->lugar = $data['lugar'];

        $event->sms_texto = $data['sms_texto'];
        $event->sms_nro = $data['sms_nro'];

        $event = self::uploadImages($event, $data);

        $event->save();

        if ( (!empty($data['localidad']) && !empty($data['valor'])) && (count($data['localidad']) == count($data['valor'])) )
        {
            foreach ($data['localidad'] as $k=>$loc)
            {
                $price = new EventPrice();
                $price->localidad = $loc;
                $price->valor_normal = $data['valor'][$k];
                $event->prices()->save($price);
            }
        }

        if (!empty($data['descuento']))
        {
            foreach ($data['descuento'] as $k=>$desc)
            {
                $discount = new EventDiscount();
                $discount->cantidad = $desc;
                $event->discounts()->save($discount);
            }
        }

        return $event;
    }

    static public function updateEvent($id, $data)
    {
        $event = AppEvent::find($id);
        $event->nombre = $data['nombre'];
        $event->descripcion = $data['descripcion'];
        $event->descripcion_larga = $data['descripcion_larga'];
        $event->post = $data['post'];
        $event->sub_categoria_id = $data['sub_categoria_id'];
        $event->fecha = $data['fecha'];
        $event->tags = $data['tags'];
        $event->legal = $data['legal'];

        $event->lat = $data['lat'];
        $event->lng = $data['lng'];
        $event->lugar = $data['lugar'];

        $event->sms_texto = $data['sms_texto'];
        $event->sms_nro = $data['sms_nro'];

        $event = self::uploadImages($event, $data);

        $event_array = $event->toArray();
        $event_validator = Validator::make($event_array, self::$validation);
        if ($event_validator->fails())
        {
            return $event;
        }
        else
        {
            if ($event->save())
            {
                $event->validator = $event_validator;
                return $event;
            }
        }
    }

    static public function uploadImages($event, $data)
    {
        $object_dir = 'events';
        $name_prefix = hash('sha1', $event->lat . ' - ' . $event->lng);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['icono'])
        {
            $ext = $data['icono']->getClientOriginalExtension();
            if ($data['icono']->move($dir, $name_prefix . '_icono.' . $ext))
            {
                $event->icono = 'img/' . $object_dir . '/' . $name_prefix . '_icono.' . $ext;
            }
        }
        if ($data['imagen_grande'])
        {
            $ext = $data['imagen_grande']->getClientOriginalExtension();
            if ($data['imagen_grande']->move($dir, $name_prefix . '_grande.' . $ext))
            {
                $event->imagen_grande = 'img/' . $object_dir . '/' . $name_prefix . '_grande.' . $ext;
            }
        }
        if ($data['imagen_chica'])
        {
            $ext = $data['imagen_chica']->getClientOriginalExtension();
            if ($data['imagen_chica']->move($dir, $name_prefix . '_chica.' . $ext))
            {
                $event->imagen_chica = 'img/' . $object_dir . '/' . $name_prefix . '_chica.' . $ext;
            }
        }
        if ($data['imagen_titulo'])
        {
            $ext = $data['imagen_titulo']->getClientOriginalExtension();
            if ($data['imagen_titulo']->move($dir, $name_prefix . '_titulo.' . $ext))
            {
                $event->imagen_titulo = 'img/' . $object_dir . '/' . $name_prefix . '_titulo.' . $ext;
            }
        }

        if ($data['imagen_grande_web'])
        {
            $ext = $data['imagen_grande_web']->getClientOriginalExtension();
            if ($data['imagen_grande_web']->move($dir, $name_prefix . '_grande_web.' . $ext))
            {
                $event->imagen_grande_web = 'img/' . $object_dir . '/' . $name_prefix . '_grande_web.' . $ext;
            }
        }

        if ($data['imagen_ubicacion'])
        {
            $ext = $data['imagen_ubicacion']->getClientOriginalExtension();
            if ($data['imagen_ubicacion']->move($dir, $name_prefix . '_ubicacion.' . $ext))
            {
                $event->imagen_ubicacion = 'img/' . $object_dir . '/' . $name_prefix . '_ubicacion.' . $ext;
            }
        }

        if ($data['imagen_bg'])
        {
            $ext = $data['imagen_bg']->getClientOriginalExtension();
            if ($data['imagen_bg']->move($dir, $name_prefix . '_bg.' . $ext))
            {
                $event->imagen_bg = 'img/' . $object_dir . '/' . $name_prefix . '_bg.' . $ext;
            }
        }
        return $event;
    }
}