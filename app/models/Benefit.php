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

    public static function validate($input, $options = array())
    {
        if (!empty($options) && isset($options['except']))
        {
            foreach ($options['except'] as $ignored_field)
            {
                unset(self::$validation[$ignored_field]);
            }
        }
        $benefit_validator = Validator::make($input, Benefit::$validation);
        return $benefit_validator;
    }
    
    static public function getBenefit($id)
    {
        $benefit = self::with('comments', 'sub_category')->find($id);
        if ($benefit->exists)
        {
            $benefit->imagen_titulo = asset($benefit->imagen_titulo);
            $benefit->imagen_grande = asset($benefit->imagen_grande);
            $benefit->imagen_chica = asset($benefit->imagen_chica);
            $benefit->icono = asset($benefit->icono);
            return $benefit;
        }
        return false;
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
        $name_prefix = hash('sha1', $benefit->lat . ' - ' . $benefit->lng);

        if ($data['icono'] && $data['icono']->move('public/img/benefits/', $name_prefix . '_icono.png'))
        {
            $ext = $data['icono']->getClientOriginalExtension();
            $benefit->icono = 'img/benefits/' . $name_prefix . '_icono.' . $ext;
        }
        if ($data['imagen_grande'] && $data['imagen_grande']->move('public/img/benefits/', $name_prefix . '_grande.png'))
        {
            $ext = $data['imagen_grande']->getClientOriginalExtension();
            $benefit->imagen_grande = 'img/benefits/' . $name_prefix . '_grande.' . $ext;
        }
        if ($data['imagen_chica'] && $data['imagen_chica']->move('public/img/benefits/', $name_prefix . '_chica.png'))
        {
            $ext = $data['imagen_chica']->getClientOriginalExtension();
            $benefit->imagen_chica = 'img/benefits/' . $name_prefix . '_chica.' . $ext;
        }
        if ($data['imagen_titulo'] && $data['imagen_titulo']->move('public/img/benefits/', $name_prefix . '_titulo.png'))
        {
            $ext = $data['imagen_titulo']->getClientOriginalExtension();
            $benefit->imagen_titulo = 'img/benefits/' . $name_prefix . '_titulo.' . $ext;
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
        })->get();
        return $results;
    }

    static public function findByLocation($user_id, $lat, $lng)
    {
        $ignored_benefits = BenefitIgnore::where('usuario_id', $user_id)->get();
        $ignored_ids = array();
        foreach ($ignored_benefits as $ib)
        {
            array_push($ignored_ids, $ib->beneficio_id);
        }

        $models = array();
        if (!empty($ignored_ids))
        {
            $benefits = self::with('sub_category', 'comments')->whereNotIn('id', $ignored_ids)->get();
        }
        else
        {
            $benefits = self::with('sub_category', 'comments')->get();
        }

        foreach ($benefits as $model)
        {
            $distance = self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                array('lat' => $model->lat, 'lng' => $model->lng));

            $model->distancia = $distance;
            $model->imagen_titulo = asset($model->imagen_titulo);
            $model->imagen_grande = asset($model->imagen_grande);
            $model->imagen_chica = asset($model->imagen_chica);
            $model->icono = asset($model->icono);
            array_push($models, $model->toArray());
        }
        $models = array_values(array_sort($models, function($value)
        {
            return $value['distancia'];
        }));
        return $models;
    }
} 