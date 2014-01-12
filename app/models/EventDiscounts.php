<?php
class EventDiscount extends BaseModel {

    protected $table = 'eventos_descuentos';

    public $timestamps = false;

    static public $rules = array(
        'cantidad' => 'required'
    );

    public function event()
    {
        return $this->belongsTo('AppEvent', 'evento_id');
    }

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$rules[$ignored_field]);
            }
        }
        $validator = Validator::make($input, self::$rules);
        return $validator;
    }

    static public function getDiscount($id)
    {
        if ($id)
        {
            $discount = self::with('event')->find($id);
            if ($discount && $discount->exists)
            {
                return $discount;
            }
        }
        return false;
    }

    static public function getDiscounts()
    {
        return self::with('event')->get();
    }

    static public function createDiscount($data)
    {
        $discount = new self();
        $discount->cantidad = $data['cantidad'];

        $discount->save();
        return $discount;
    }

    static public function updateDiscount($id, $data)
    {
        $discount = self::find($id);
        $discount->cantidad = $data['cantidad'];

        $discount_array = $discount->toArray();
        $discount_validator = Validator::make($discount_array, self::$validation);
        if ($discount_validator->fails())
        {
            return $discount;
        }
        else
        {
            if ($discount->save())
            {
                $discount->validator = $discount_validator;
                return $discount;
            }
        }
    }
} 