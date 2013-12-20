<?php
class BenefitRedeem extends BaseModel {
    protected $table = 'beneficios_cobrados';

    public $timestamps = false;

    public function benefit()
    {
        return $this->belongsTo('Benefit', 'beneficio_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'usuario_id');
    }

    static public function redeem($id, $user_id)
    {
        $benefit = Benefit::find($id)->first();
        if ($benefit)
        {
            $redeemed = new BenefitRedeem();
            $redeemed->beneficio_id = $id;
            $redeemed->usuario_id = $user_id;
            $redeemed->created_at = date('Y-m-d H:i:s');
            if ($redeemed->save())
            {
                return true;
            }
        }
        return false;
    }
} 