<?php
class Summer extends BaseModel {

    protected $table = 'veranos';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $rules = array(
        'nombre' => 'required',
        'descripcion' => 'required',
        'descripcion_larga' => 'required',
        'texto_beneficio' => 'required',
        'horario' => 'required',
        'lugar' => 'required',
        'fecha' => 'required',
        'legal' => 'required',
        'sms_nro' => 'required',
        'sms_texto' => 'required',
        'imagen_descripcion' => 'required',
        'imagen_titulo' => 'required'
    );

    public function category()
    {
        return $this->belongsTo('SummerCategory', 'categoria_id');
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

    static public function getSummer($id)
    {
        if ($id)
        {
            $summer = self::with('category')->find($id);
            if ($summer && $summer->exists)
            {
                return $summer->prepareForWS();
            }
        }
        return false;
    }

    static public function getSummers()
    {
        return self::with('category')->get()->each(function($summer)
        {
            $summer->prepareForWS();
        });
    }

    static public function createSummer($data)
    {
        $summer = new self();
        $summer->nombre = $data['nombre'];
        $summer->descripcion = $data['descripcion'];
        $summer->descripcion_larga = $data['descripcion_larga'];
        $summer->texto_beneficio = $data['texto_beneficio'];
        $summer->horario = $data['horario'];
        $summer->lugar = $data['lugar'];
        $summer->fecha = $data['fecha'];
        $summer->legal = $data['legal'];
        $summer->sms_nro = $data['sms_nro'];
        $summer->sms_texto = $data['sms_texto'];
	    $summer->categoria_id = $data['categoria_id'];

        $summer = self::uploadImages($summer, $data);

        $summer->save();
        return $summer;
    }

    static public function updateSummer($id, $data)
    {
        $summer = self::find($id);
        $summer->nombre = $data['nombre'];
        $summer->descripcion = $data['descripcion'];
        $summer->descripcion_larga = $data['descripcion_larga'];
        $summer->texto_beneficio = $data['texto_beneficio'];
        $summer->horario = $data['horario'];
        $summer->lugar = $data['lugar'];
        $summer->fecha = $data['fecha'];
        $summer->legal = $data['legal'];
        $summer->sms_nro = $data['sms_nro'];
        $summer->sms_texto = $data['sms_texto'];
	    $summer->categoria_id = $data['categoria_id'];

        $summer = self::uploadImages($summer, $data);

        $summer_array = $summer->toArray();
        $summer_validator = Validator::make($summer_array, self::$rules);
        if ($summer_validator->fails())
        {
            return $summer;
        }
        else
        {
            if ($summer->save())
            {
                $summer->validator = $summer_validator;
                return $summer;
            }
        }
    }

    static public function uploadImages($summer, $data)
    {
        $object_dir = 'summers';
        $name_prefix = hash('sha1', $summer->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

	    $image_fields = array('imagen_descripcion', 'imagen_titulo');

	    foreach ($image_fields as $ifield)
	    {
		    if (isset($data[$ifield]) && ($data[$ifield] && $data[$ifield] != ''))
		    {
			    $ext = $data[$ifield]->getClientOriginalExtension();
			    if ($data[$ifield]->move($dir, $name_prefix . '_' . $ifield . '.' . $ext))
			    {
				    $summer->$ifield = 'img/' . $object_dir . '/' . $name_prefix . '_' . $ifield . '.' . $ext;
			    }
		    }
	    }

        return $summer;
    }

    public function prepareForWS()
    {
        $this->imagen_titulo = asset($this->imagen_titulo);
        $this->imagen_descripcion = asset($this->imagen_descripcion);
        return $this;
    }
} 