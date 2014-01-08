<?php
class Benefit extends LocationModel {

    protected $table = 'beneficios';

    protected $hidden = array(
        'created_at', 'updated_at', 'last_login', 'caducado'
    );

    static public $validation = array(
        'nombre' => 'required',
        'descripcion' => 'required',
        'legal' => 'required',
        'sub_categoria_id' => 'required',
        'fecha' => 'required',
        'tags' => 'required',
        'lat' => 'required',
        'lng' => 'required',
        'lugar' => 'required',
        'sms_texto' => 'required',
        'sms_nro' => 'required',
        'icono' => 'required',
        'imagen_grande' => 'required',
        'imagen_chica' => 'required',
        'imagen_titulo' => 'required'
    );

    public function sub_category()
    {
        return $this->belongsTo('BenefitSubCategory', 'sub_categoria_id');
    }

    public function comments()
    {
        return $this->hasMany('BenefitComment', 'beneficio_id');
    }

    public function votes()
    {
        return $this->hasMany('BenefitVote', 'beneficio_id');
    }

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$validation[$ignored_field]);
            }
        }
        $validator = Validator::make($input, self::$validation);
        return $validator;
    }
    
    static public function getBenefit($id)
    {
        $benefit = self::with(array('votes' => function($query)
            {
                $query->where('usuario_id', Auth::getUser()->id);
            }, 'comments', 'sub_category'))->find($id);
        if ($benefit && $benefit->exists)
        {
            $benefit->prepareForWS();
            $benefit->sub_category->prepareForWS();
            return $benefit;
        }
        return false;
    }

    static public function getBenefits()
    {
        $benefits = self::with(array('votes' => function($query)
            {
                $query->where('usuario_id', Auth::getUser()->id);
            }, 'comments', 'sub_category'))->get()->each(function($benefit)
            {
                $benefit->prepareForWS();
                $benefit->sub_category->prepareForWS();
            });
        return $benefits;
    }
    
    public function prepareForWS()
    {
        $this->imagen_titulo = asset($this->imagen_titulo);
        $this->imagen_grande = asset($this->imagen_grande);
        $this->imagen_chica = asset($this->imagen_chica);
        $this->icono = asset($this->icono);
        $this->imagen_grande_web = asset($this->imagen_grande_web);
    }

    static public function createBenefit($data)
    {
        $benefit = new Benefit();
        $benefit->nombre = $data['nombre'];
        $benefit->descripcion = $data['descripcion'];
        $benefit->legal = $data['legal'];
        $benefit->sub_categoria_id = $data['sub_categoria_id'];
        $benefit->fecha = $data['fecha'];
        $benefit->rating = 0;
        $benefit->tags = $data['tags'];

        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->lugar = $data['lugar'];

        $benefit->sms_texto = $data['sms_texto'];
        $benefit->sms_nro = $data['sms_nro'];

        $benefit = self::uploadImages($benefit, $data);

        $benefit->save();
        return $benefit;
    }

    static public function updateBenefit($id, $data)
    {
        $benefit = Benefit::find($id);
        $benefit->nombre = $data['nombre'];
        $benefit->descripcion = $data['descripcion'];
        $benefit->legal = $data['legal'];
        $benefit->sub_categoria_id = $data['sub_categoria_id'];
        $benefit->fecha = $data['fecha'];
        $benefit->rating = isset($data['rating']) ? $data['rating'] : 0;
        $benefit->tags = $data['tags'];

        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->lugar = $data['lugar'];

        $benefit->sms_texto = $data['sms_texto'];
        $benefit->sms_nro = $data['sms_nro'];

        $benefit = self::uploadImages($benefit, $data);

        $benefit_array = $benefit->toArray();
        $benefit_validator = Validator::make($benefit_array, self::$validation);
        if ($benefit_validator->fails())
        {
            return $benefit;
        }
        else
        {
            if ($benefit->save())
            {
                $benefit->validator = $benefit_validator;
                return $benefit;
            }
        }
    }

    static public function uploadImages($benefit, $data)
    {
        $object_dir = 'benefits';
        $name_prefix = hash('sha1', $benefit->lat . ' - ' . $benefit->lng);
        $dir = public_path() . '/' . 'img' . '/' . $object_dir . '/';

        if ($data['icono'])
        {
            $ext = $data['icono']->getClientOriginalExtension();
            if ($data['icono']->move($dir, $name_prefix . '_icono.' . $ext))
            {
                $benefit->icono = 'img/' . $object_dir . '/' . $name_prefix . '_icono.' . $ext;
            }
        }
        if ($data['imagen_grande'])
        {
            $ext = $data['imagen_grande']->getClientOriginalExtension();
            if ($data['imagen_grande']->move($dir, $name_prefix . '_grande.' . $ext))
            {
                $benefit->imagen_grande = 'img/' . $object_dir . '/' . $name_prefix . '_grande.' . $ext;
            }
        }
        if ($data['imagen_chica'])
        {
            $ext = $data['imagen_chica']->getClientOriginalExtension();
            if ($data['imagen_chica']->move($dir, $name_prefix . '_chica.' . $ext))
            {
                $benefit->imagen_chica = 'img/' . $object_dir . '/' . $name_prefix . '_chica.' . $ext;
            }
        }
        if ($data['imagen_titulo'])
        {
            $ext = $data['imagen_titulo']->getClientOriginalExtension();
            if ($data['imagen_titulo']->move($dir, $name_prefix . '_titulo.' . $ext))
            {
                $benefit->imagen_titulo = 'img/' . $object_dir . '/' . $name_prefix . '_titulo.' . $ext;
            }
        }
        return $benefit;
    }

    static public function disableBenefitToggle($id)
    {
        $benefit = self::find($id);
        $benefit->caducado = !$benefit->caducado;
        return $benefit->save();
    }

    static public function recalculateRating($id)
    {
        $benefit = self::find($id);

        if ($benefit)
        {
            $benefit->rating = self::calculateRating($id);
            return $benefit->save();
        }
        return false;
    }

    static public function calculateRating($id)
    {
        $counter = 0;
        $votes = BenefitVote::where('beneficio_id', $id)->get();
        if ($votes)
        {
            foreach ($votes as $vote)
            {
                $counter += $vote->votacion;
            }
            if (count($votes) == 0)
            {
                $rating = $counter;
            }
            else
            {
                $rating = $counter/count($votes);
            }
        }
        return $rating;
    }

    static public function findByRating()
    {
        $models = array();

        foreach (self::with('sub_category', 'comments')->get() as $model)
        {
            $model->imagen_titulo = asset($model->imagen_titulo);
            $model->imagen_grande = asset($model->imagen_grande);
            $model->imagen_chica = asset($model->imagen_chica);
            $model->icono = asset($model->icono);
            array_push($models, $model->toArray());
        }
        $models = array_values(array_sort($models, function($value)
        {
            return -$value['rating'];
        }));
        return $models;
    }

    static public function searchByKeyword($q = null)
    {
        $results = Benefit::with('sub_category', 'comments')->where(function($query) use ($q)
        {
            $query->where('nombre', 'LIKE', '%' . $q . '%');
            $query->orWhere('descripcion', 'LIKE', '%' . $q . '%');
            $query->orWhere('tags', 'LIKE', '%' . $q . '%');
        })->get()->each(function($benefit)
            {
                $benefit->prepareForWS();
            });
        return $results;
    }

    static public function findByLocation($lat, $lng, $user_id, $range = null, $limit = null)
    {
        $ignored_benefits = BenefitIgnore::where('usuario_id', $user_id)->get();
        $ignored_ids = array();
        foreach ($ignored_benefits as $ib)
        {
            array_push($ignored_ids, $ib->beneficio_id);
        }

        $models = array();
        $query = self::with('sub_category', 'comments');
        if (!empty($ignored_ids))
        {
            $query = $query->whereNotIn('id', $ignored_ids);
            $benefits = $query->get();
        }
        else
        {
            $benefits = $query->get();
        }

        foreach ($benefits as $model)
        {
            $distance = self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                array('lat' => $model->lat, 'lng' => $model->lng));
            if ($range)
            {
                if (is_numeric($range) && $distance <= $range)
                {
                    $model->distancia = $distance;
                    $model->prepareForWS();
                    $model->sub_category->prepareForWS();
                    array_push($models, $model->toArray());
                }
            }
            else
            {
                $model->distancia = $distance;
                $model->prepareForWS();
                $model->sub_category->prepareForWS();
                array_push($models, $model->toArray());
            }
        }
        $models = array_values(array_sort($models, function($value)
        {
            return $value['distancia'];
        }));
        if ($limit && is_int($limit))
        {
            $models = array_slice($models, 0, $limit);
        }
        return $models;
    }
} 