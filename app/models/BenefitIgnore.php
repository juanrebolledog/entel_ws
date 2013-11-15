<?php

class BenefitIgnore extends BaseModel {
    protected $table = 'benefit_ignored';
    static public function saveIgnore($benefit_id, $user_id)
    {
        $benefit_query = BenefitIgnore::where('user_id', '=', $user_id);
        $benefit = $benefit_query->first();
        if (!$benefit->exists)
        {
            $benefit = new BenefitIgnore();
            $benefit->user_id = $user_id;
            $benefit->benefit_id = $benefit_id;
            return $benefit->save();
        }
        return $benefit_query->delete();
    }
} 