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

        if ($data['icono']->move('public/img/events/', 'icono_1.png'))
        {
            $event->icono = 'img/events/icono_1.png';
        }
        if ($data['imagen_grande']->move('public/img/events/', 'imagen_grande_1.png'))
        {
            $event->imagen_grande = 'img/events/imagen_grande_1.png';
        }
        if ($data['imagen_chica']->move('public/img/events/', 'imagen_chica_1.png'))
        {
            $event->imagen_chica = 'img/events/imagen_chica_1.png';
        }
        if ($data['imagen_titulo']->move('public/img/events/', 'imagen_titulo_1.png'))
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
} 