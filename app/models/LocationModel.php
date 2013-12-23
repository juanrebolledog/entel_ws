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
} 