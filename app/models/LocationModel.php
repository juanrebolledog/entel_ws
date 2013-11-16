<?php
class LocationModel extends \BaseModel {
    static public function calculateDistance($org, $dst)
    {
        $earth_radius = 6367500;
        $d_lat = deg2rad($dst['lat'] - $org['lat']);
        $d_lon = deg2rad($dst['lng'] - $org['lng']);

        $a = sin($d_lat / 2) * sin($d_lat / 2) + cos(deg2rad($org['lat'])) *
            cos(deg2rad($dst['lat'])) * sin($d_lon / 2) * sin($d_lon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
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
                'rating' => $model->rating(),
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