<?php

class Benefit extends LocationModel {
    protected $table = 'benefits';
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
        $votes = BenefitVote::where('benefit_id', $id)->get();
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
                'name' => $model->name,
                'description' => $model->description,
                'lat' => $model->lat,
                'lng' => $model->lng,
                'special' => (bool)$model->special,
                'min_points' => $model->min_points,
                'rating' => $model->rating
            ));
        }
        $models = array_values(array_sort($models, function($value)
        {
            return -$value['rating'];
        }));
        return $models;
    }
} 