<?php

class BenefitVote extends BaseModel {
    protected $table = 'notas';
    static public function saveVote($benefit_id, $user_id, $vote_value)
    {
        $vote_query = BenefitVote::where('user_id', $user_id)->where('benefit_id', $benefit_id);
        $vote = $vote_query->first();
        if (!$vote) {
            $vote = new BenefitVote();
            $vote->user_id = $user_id;
            $vote->benefit_id = $benefit_id;
            $vote->vote = $vote_value;
            if ($vote->save())
            {
                Benefit::recalculateRating($benefit_id);
                return $vote;
            }
        }
        if ($vote_query->update(array('vote' => $vote_value)))
        {
            Benefit::recalculateRating($benefit_id);
            $vote = $vote_query->first();
        }
        return $vote;
    }
} 