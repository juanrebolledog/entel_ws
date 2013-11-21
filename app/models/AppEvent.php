<?php

class AppEvent extends LocationModel {
    protected $table = 'eventos';

    static public function findByLocation($lat, $lng)
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
} 