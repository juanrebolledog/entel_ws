<?php
class EventPrice extends BaseModel {

    protected $table = 'eventos_precios';

    public $timestamps = false;

    static public $rules = array(
        'localidad' => 'required',
        'valor' => 'required'
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

    static public function getPrice($id)
    {
        if ($id)
        {
            $price = self::with('event')->find($id);
            if ($price && $price->exists)
            {
                return $price;
            }
        }
        return false;
    }

    static public function getPrices()
    {
        return self::with('event')->get();
    }

    static public function createPrice($data)
    {
        $price = new self();
        $price->valor_normal = $data['valor_normal'];
        $price->localidad = $data['localidad'];

        $price->save();
        return $price;
    }

    static public function updatePrice($id, $data)
    {
        $price = self::find($id);
        $price->valor_normal = $data['valor_normal'];
        $price->localidad = $data['localidad'];

        $price_array = $price->toArray();
        $price_validator = Validator::make($price_array, self::$validation);
        if ($price_validator->fails())
        {
            return $price;
        }
        else
        {
            if ($price->save())
            {
                $price->validator = $price_validator;
                return $price;
            }
        }
    }
} 