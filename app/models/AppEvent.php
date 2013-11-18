<?php

class AppEvent extends LocationModel {
    protected $table = 'events';

    public function media() {
        return $this->hasMany('EventMedia');
    }

    static public function findByLocation($lat, $lng)
    {
        $models = array();

        foreach (self::all() as $model)
        {
            $distance = self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                array('lat' => $model->lat, 'lng' => $model->lng));

            array_push($models, array(
                'id' => $model->id,
                'name' => $model->name,
                'description' => $model->description,
                'lat' => $model->lat,
                'lng' => $model->lng,
                'special' => (bool)$model->special,
                'min_points' => $model->min_points,
                'distance' => $distance
            ));
        }
        $models = array_values(array_sort($models, function($value)
        {
            return $value['distance'];
        }));
        return $models;
    }
} 