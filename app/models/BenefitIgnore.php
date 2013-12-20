<?php

class BenefitIgnore extends BaseModel {
    protected $table = 'beneficios_ignorados';

    public $timestamps = false;

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    static public function saveIgnore($benefit_id, $user_id)
    {
        $benefit_query = BenefitIgnore::where('usuario_id', '=', $user_id);
        $benefit = $benefit_query->first();
        if (!$benefit)
        {
            $benefit = new BenefitIgnore();
            $benefit->usuario_id = $user_id;
            $benefit->beneficio_id = $benefit_id;
            $benefit->created_at = date('Y-m-d H:i:s');
            $benefit->save();
            return true;
        }
        return $benefit_query->delete();
    }
} 