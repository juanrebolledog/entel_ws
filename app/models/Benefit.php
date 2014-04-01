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

    public function images()
    {
        return $this->hasMany('BenefitImage', 'beneficio_id');
    }

    public function locations()
    {
        return $this->hasMany('BenefitLocation', 'beneficio_id');
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

    static public function getBenefits($user_id)
    {
        $ignored_benefits = BenefitIgnore::where('usuario_id', $user_id)->get();
        $ignored_ids = array();
        foreach ($ignored_benefits as $ib)
        {
            array_push($ignored_ids, $ib->beneficio_id);
        }

        $benefits = self::with(array('votes' => function($query) use ($user_id)
            {
                $query->where('usuario_id', $user_id);
            }, 'comments', 'sub_category', 'locations'));

        if (!empty($ignored_ids))
        {
            $benefits = $benefits->whereNotIn('id', $ignored_ids);
        }
        $benefits = $benefits->get()->each(function($benefit)
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
        $this->imagen_descripcion = asset($this->imagen_descripcion);
        return $this;
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

        $benefit->sms_texto = $data['sms_texto'];
        $benefit->sms_nro = $data['sms_nro'];

        $benefit = self::uploadImages($benefit, $data);

        $benefit->save();
        foreach ($data['location'] as $k=>$loc)
        {
            if (is_array($loc) && is_numeric($loc['lat']))
            {
                $location = new BenefitLocation();
                $location->lat = $loc['lat'];
                $location->lng = $loc['lng'];
                $location->lugar = $loc['lugar'];
                $benefit->locations()->save($location);
            }
        }
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

        /*
        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->lugar = $data['lugar'];
        */

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
                foreach ($data['location'] as $k=>$loc)
                {
                    if (is_array($loc))
                    {
                        if (isset($loc['id']))
                        {
                            $location = BenefitLocation::find($loc['id']);
                        }
                        else
                        {
                            $location = new BenefitLocation();
                        }
                        $location->lat = $loc['lat'];
                        $location->lng = $loc['lng'];
                        $location->lugar = $loc['lugar'];
                        $benefit->locations()->save($location);
                    }
                }
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
        $image_fields = array('icono', 'imagen_grande', 'imagen_grande_web', 'imagen_chica', 'imagen_titulo', 'imagen_descripcion');

        foreach ($image_fields as $ifield)
        {
            if (isset($data[$ifield]) && ($data[$ifield] && $data[$ifield] != ''))
            {
                $ext = $data[$ifield]->getClientOriginalExtension();
                if ($data[$ifield]->move($dir, $name_prefix . '_' . $ifield . '.' . $ext))
                {
                    $benefit->$ifield = 'img/' . $object_dir . '/' . $name_prefix . '_' . $ifield . '.' . $ext;
                }
            }
            else
            {
                $benefit->$ifield = '';
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
            $model->prepareForWS();
            $model->locations = array();
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
                $benefit->locations = array();
                $benefit->prepareForWS();
                $benefit->sub_category->prepareForWS();
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

        $query = self::with('sub_category', 'comments');

        if (!empty($ignored_ids))
        {
            $query = $query->whereNotIn('id', $ignored_ids);
        }

        $benefits = $query->get();

        foreach ($benefits as $benefit)
        {
            $benefit_locations = array();
            foreach (BenefitLocation::getLocations($benefit->id) as $location)
            {
                $location->distancia = round(self::calculateDistance(array('lat' => $lat, 'lng' => $lng),
                    array('lat' => $location->lat, 'lng' => $location->lng)));

                if ($range)
                {
                    //if ($location->distancia <= Config::get('app.search_limit') && $location->distancia <= $range)
                    if ($location->distancia <= $range)
                    {
                        array_push($benefit_locations, $location->toArray());
                    }
                }
                else
                {
                    if ($location->distancia <= Config::get('app.search_limit'))
                    {
                        array_push($benefit_locations, $location->toArray());
                    }
                }
            }
            $benefit->locations = $benefit_locations;
        }

        $benefits = $benefits->filter(function($benefit)
        {
            if (!empty($benefit->locations))
            {
                return $benefit;
            }
        })->each(function($benefit)
            {
                $benefit->prepareForWS();
                $benefit->sub_category->prepareForWS();
            });

        if ($limit && is_int($limit))
        {
            $benefits = $benefits->take($limit);
        }
        return $benefits;
    }

    static public function random($num = 1)
    {
        $db = Config::get('database.default');
        if ($db == 'sqlite')
        {
            $random_string = 'RANDOM()';
        }
        else
        {
            $random_string = 'RAND()';
        }
        return self::orderBy(DB::raw($random_string))->take($num)->get()->each(function($obj)
        {
            $obj->prepareForWS();
        });
    }
} 