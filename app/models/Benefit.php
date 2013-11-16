<?php

class Benefit extends LocationModel {
    protected $table = 'benefits';
    static public function recalculateRating($id)
    {
        $benefit = self::find($id);
        $counter = 0;
        if ($benefit)
        {
            $votes = BenefitVote::where('benefit_id', $id)->get();
            if ($votes)
            {

                foreach ($votes as $vote)
                {
                    $counter += $vote->vote;
                }
                $rating = $counter/count($votes);
            }
            $benefit->rating = $rating;
            return $benefit->save();
        }
        return false;
    }
} 