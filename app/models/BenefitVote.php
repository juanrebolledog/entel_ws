<?php

class BenefitVote extends BaseModel {

    protected $table = 'notas';

    static protected $max_vote_value = 5;

    static protected $min_vote_value = 1;

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    static public function saveVote($benefit_id, $user_id, $vote_value)
    {
        $vote_query = BenefitVote::where('usuario_id', $user_id)->where('beneficio_id', $benefit_id);
        $vote = $vote_query->first();
        if (!$vote) {
            $vote = new BenefitVote();
            $vote->usuario_id = $user_id;
            $vote->beneficio_id = $benefit_id;

            if ($vote_value > self::$max_vote_value)
            {
                $vote_value = self::$max_vote_value;
            }

            if ($vote_value < self::$min_vote_value)
            {
                $vote_value = self::$min_vote_value;
            }

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

    static public function getVotes($benefit_id = null)
    {
        $votes_query = BenefitVote::with('user', 'benefit');
        if ($benefit_id)
        {
            $votes_query->where('beneficio_id', $benefit_id);
        }
        return $votes_query->get();
    }
} 