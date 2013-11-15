<?php

class BenefitIgnore extends BaseModel {
    protected $table = 'benefit_ignored';
    public $timestamps = false;
    static public function saveIgnore($benefit_id, $user_id)
    {
        $benefit_query = BenefitIgnore::where('user_id', '=', $user_id);
        $benefit = $benefit_query->first();
        if (!$benefit)
        {
            $benefit = new BenefitIgnore();
            $benefit->user_id = $user_id;
            $benefit->benefit_id = $benefit_id;
            $benefit->created_at = date('Y-m-d H:i:s');
            $benefit->save();
            return true;
        }
        return $benefit_query->delete();
    }
} 