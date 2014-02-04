<?php
class Contest extends BaseModel {

    protected $table = 'concursos';

    public $timestamps = false;

    static public $rules = array(
        'nombre' => 'required',
        'descripcion' => 'required',
        'imagen_banner' => 'required'
    );

    public function winners()
    {
        return $this->hasMany('ContestWinner', 'concurso_id');
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

    static public function getContest($id)
    {
        if ($id)
        {
            $contest = self::with('winners')->find($id);
            if ($contest && $contest->exists)
            {
                return $contest->prepareForWS();
            }
        }
        return false;
    }

    static public function getContests()
    {
        return self::with('winners')->get()->each(function($contest)
        {
            $contest->prepareForWS();
        });
    }

    static public function createContest($data)
    {
        $contest = new self();
        $contest->nombre = $data['nombre'];
        $contest->descripcion = $data['descripcion'];

        $contest = self::uploadImages($contest, $data);

        $contest->save();

	    if (!empty($data['nombres']) && !empty($data['rut']))
	    {
		    foreach ($data['nombres'] as $k=>$nombre)
		    {
			    $winner = new ContestWinner();
			    $winner->nombres = $nombre;
			    $winner->rut = $data['rut'][$k];
			    $contest->winners()->save($winner);
		    }
	    }

        return $contest;
    }

    static public function updateContest($id, $data)
    {
        $contest = self::with('winners')->find($id);
        $contest->nombre = $data['nombre'];
        $contest->descripcion = $data['descripcion'];

        $contest = self::uploadImages($contest, $data);

	    if ($contest->save())
	    {
		    if (!empty($data['ganadores_n']))
		    {
			    foreach ($data['ganadores_n']['nombres'] as $k=>$nombre)
			    {
				    $winner = new ContestWinner();
				    $winner->nombres = $nombre;
				    $winner->rut = $data['ganadores_n']['rut'][$k];
				    $contest->winners()->save($winner);
			    }
		    }
		    return $contest;
	    }
    }

    static public function uploadImages($contest, $data)
    {
        $object_dir = 'contests';
        $name_prefix = hash('sha1', $contest->nombre);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['imagen_banner'])
        {
            $ext = $data['imagen_banner']->getClientOriginalExtension();
            if ($data['imagen_banner']->move($dir, $name_prefix . '_banner.' . $ext))
            {
                $contest->imagen_banner = 'img/' . $object_dir . '/' . $name_prefix . '_banner.' . $ext;
            }
        }

        return $contest;
    }

    public function prepareForWS()
    {
        $this->imagen_banner = asset($this->imagen_banner);
        return $this;
    }
} 