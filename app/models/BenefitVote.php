<?php

class BenefitVote extends BaseModel {
    protected $table = 'notas';
    static public function saveVote($benefit_id, $user_id, $vote_value)
    {
        $vote_query = BenefitVote::where('usuario_id', $user_id)->where('beneficio_id', $benefit_id);
        $vote = $vote_query->first();
        if (!$vote) {
            $vote = new BenefitVote();
            $vote->usuario_id = $user_id;
            $vote->beneficio_id = $benefit_id;
            $vote->votacion = $vote_value;
            if ($vote->save())
            {
                Benefit::recalculateRating($benefit_id);
                return $vote;
            }
        }
        if ($vote_query->update(array('votacion' => $vote_value)))
        {
            Benefit::recalculateRating($benefit_id);
            $vote = $vote_query->first();
        }
        return $vote;
    }
} 