<?php

class BenefitVote extends BaseModel {
    static public function saveVote($benefit_id, $user_id, $vote)
    {
        $benefit_query = BenefitVote::where('user_id', '=', $user_id);
        $benefit = $benefit_query->first();
        if (!$benefit->exists) {
            $benefit = new BenefitVote();
            $benefit->user_id = $user_id;
            $benefit->benefit_id = $benefit_id;
            $benefit->vote = $vote;
            return $benefit->save();
        }
        return $benefit_query->update(array('vote' => $vote));
    }
} 