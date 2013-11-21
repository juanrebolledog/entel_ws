<?php
class Benefit extends LocationModel {

    protected $table = 'beneficios';

    static public function createBenefit($data)
    {
        $benefit = new Benefit();
        $benefit->nombre = $data['nombre'];
        $benefit->descripcion = $data['descripcion'];
        $benefit->categoria_id = $data['categoria_id'];
        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->rating = isset($data['rating']) ? $data['rating'] : 0;
        return $benefit->save();
    }

    static public function recalculateRating($id)
    {
        $benefit = self::find($id);

        if ($benefit)
        {
            $benefit->rating = self::calculateRating($id);
            return $benefit->save();
        }
        return false;
    }

    static public function calculateRating($id)
    {
        $counter = 0;
        $votes = BenefitVote::where('beneficio_id', $id)->get();
        if ($votes)
        {
            foreach ($votes as $vote)
            {
                $counter += $vote->vote;
            }
            if (count($votes) == 0)
            {
                $rating = $counter;
            }
            else
            {
                $rating = $counter/count($votes);
            }
        }
        return $rating;
    }

    static public function findByRating()
    {
        $models = array();

        foreach (self::all() as $model)
        {
            array_push($models, array(
                'id' => $model->id,
                'nombre' => $model->nombre,
                'descripcion' => $model->descripcion,
                'lat' => $model->lat,
                'lng' => $model->lng,
                'rating' => $model->rating
            ));
        }
        $models = array_values(array_sort($models, function($value)
        {
            return -$value['rating'];
        }));
        return $models;
    }

    static public function searchByKeyword($q = null)
    {
        $results = Benefit::where(function($query) use ($q)
        {
            $query->where('nombre', 'LIKE', '%' . $q . '%');
            $query->orWhere('descripcion', 'LIKE', '%' . $q . '%');
        })->get();
        return $results;
    }
} 