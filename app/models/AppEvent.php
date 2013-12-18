<?php
class AppEvent extends LocationModel {
    protected $table = 'eventos';

    static protected $validation = array(
        'nombre' => 'required',
        'descripcion' => 'required',
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
        'imagen_titulo' => 'required'
    );
    
    public function sub_category()
    {
        return $this->belongsTo('EventSubCategory', 'sub_categoria_id');
    }

    static public function getEvent($id)
    {
        $event = self::with('sub_category')->find($id);
        if ($event && $event->exists)
        {
            $event->imagen_titulo = asset($event->imagen_titulo);
            $event->imagen_grande = asset($event->imagen_grande);
            $event->imagen_chica = asset($event->imagen_chica);
            $event->icono = asset($event->icono);
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
            $this->icono = asset($this->icono);
        }
        return true;
    }

    static public function findByLocation($user_id, $lat, $lng)
    {
        $models = array();

        foreach (self::all() as $model)
        {
            $distance = self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                array('lat' => $model->lat, 'lng' => $model->lng));

            array_push($models, array(
                'id' => $model->id,
                'nombre' => $model->name,
                'descripcion' => $model->description,
                'lat' => $model->lat,
                'lng' => $model->lng,
                'distancia' => $distance
            ));
        }
        $models = array_values(array_sort($models, function($value)
        {
            return $value['distancia'];
        }));
        return $models;
    }
    
    static public function createEvent($data)
    {
        $event = new AppEvent();
        $event->nombre = $data['nombre'];
        $event->descripcion = $data['descripcion'];
        $event->sub_categoria_id = $data['sub_categoria_id'];
        $event->fecha = $data['fecha'];
        $event->tags = $data['tags'];

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

    static public function updateEvent($id, $data)
    {
        $event = AppEvent::find($id);
        $event->nombre = $data['nombre'];
        $event->descripcion = $data['descripcion'];
        $event->sub_categoria_id = $data['sub_categoria_id'];
        $event->fecha = $data['fecha'];
        $event->tags = $data['tags'];

        $event->lat = $data['lat'];
        $event->lng = $data['lng'];
        $event->lugar = $data['lugar'];

        $event->sms_texto = $data['sms_texto'];
        $event->sms_nro = $data['sms_nro'];

        if ($data['icono'] && $data['icono']->move('public/img/events/', 'icono_1.png'))
        {
            $event->icono = 'img/events/icono_1.png';
        }
        if ($data['imagen_grande'] && $data['imagen_grande']->move('public/img/events/', 'imagen_grande_1.png'))
        {
            $event->imagen_grande = 'img/events/imagen_grande_1.png';
        }
        if ($data['imagen_chica'] && $data['imagen_chica']->move('public/img/events/', 'imagen_chica_1.png'))
        {
            $event->imagen_chica = 'img/events/imagen_chica_1.png';
        }
        if ($data['imagen_titulo'] && $data['imagen_titulo']->move('public/img/events/', 'imagen_titulo_1.png'))
        {
            $event->imagen_titulo = 'img/events/imagen_titulo_1.png';
        }

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
        return $event;
    }
} 