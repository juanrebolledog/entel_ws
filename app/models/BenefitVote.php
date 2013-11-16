<?php

class BenefitVote extends BaseModel {
    static public function saveVote($benefit_id, $user_id, $vote)
    {
        $benefit_query = BenefitVote::where('user_id', $user_id)->where('benefit_id', $benefit_id);
        $benefit = $benefit_query->first();
        if (!$benefit) {
            $benefit = new BenefitVote();
            $benefit->user_id = $user_id;
            $benefit->benefit_id = $benefit_id;
            $benefit->vote = $vote;
            if ($benefit->save())
            {
                Benefit::recalculateRating($benefit_id);
                return $benefit;
            }
        }
        if ($benefit_query->update(array('vote' => $vote)))
        {
            Benefit::recalculateRating($benefit_id);
            return $benefit;
        }
    }
} 