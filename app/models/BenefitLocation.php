<?php
class BenefitLocation extends BaseModel {

	protected $table = 'beneficios_ubicaciones';

	public $timestamps = false;

	static public $rules = array(
		'lugar' => 'required',
		'lat' => 'required',
		'lng' => 'required'
	);

	public function benefit()
	{
		return $this->belongsTo('Benefit', 'beneficio_id');
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
} 