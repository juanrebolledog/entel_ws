<?php
class Benefit extends LocationModel {

    protected $table = 'beneficios';

    static protected $validation = array(
        'nombre' => 'required',
        'descripcion' => 'required',
        'sub_categoria_id' => 'required',
        'fecha' => 'required',
        'rating' => 'required',
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

    static public function createBenefit($data)
    {
        $benefit = new Benefit();
        $benefit->nombre = $data['nombre'];
        $benefit->descripcion = $data['descripcion'];
        $benefit->sub_categoria_id = $data['sub_categoria_id'];
        $benefit->fecha = $data['fecha'];
        $benefit->rating = isset($data['rating']) ? $data['rating'] : 0;
        $benefit->tags = $data['tags'];

        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->lugar = $data['lugar'];

        $benefit->sms_texto = $data['sms_texto'];
        $benefit->sms_nro = $data['sms_nro'];

        if ($data['icono']->move('public/img/benefits/', 'icono_1.png'))
        {
            $benefit->icono = 'img/benefits/icono_1.png';
        }
        if ($data['imagen_grande']->move('public/img/benefits/', 'imagen_grande_1.png'))
        {
            $benefit->imagen_grande = 'img/benefits/imagen_grande_1.png';
        }
        if ($data['imagen_chica']->move('public/img/benefits/', 'imagen_chica_1.png'))
        {
            $benefit->imagen_chica = 'img/benefits/imagen_chica_1.png';
        }
        if ($data['imagen_titulo']->move('public/img/benefits/', 'imagen_titulo_1.png'))
        {
            $benefit->imagen_titulo = 'img/benefits/imagen_titulo_1.png';
        }

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

    static public function updateBenefit($id, $data)
    {
        $benefit = Benefit::find($id);
        $benefit->nombre = $data['nombre'];
        $benefit->descripcion = $data['descripcion'];
        $benefit->sub_categoria_id = $data['sub_categoria_id'];
        $benefit->fecha = $data['fecha'];
        $benefit->rating = isset($data['rating']) ? $data['rating'] : 0;
        $benefit->tags = $data['tags'];

        $benefit->lat = $data['lat'];
        $benefit->lng = $data['lng'];
        $benefit->lugar = $data['lugar'];

        $benefit->sms_texto = $data['sms_texto'];
        $benefit->sms_nro = $data['sms_nro'];

        if ($data['icono'] && $data['icono']->move('public/img/benefits/', 'icono_1.png'))
        {
            $benefit->icono = 'img/benefits/icono_1.png';
        }
        if ($data['imagen_grande'] && $data['imagen_grande']->move('public/img/benefits/', 'imagen_grande_1.png'))
        {
            $benefit->imagen_grande = 'img/benefits/imagen_grande_1.png';
        }
        if ($data['imagen_chica'] && $data['imagen_chica']->move('public/img/benefits/', 'imagen_chica_1.png'))
        {
            $benefit->imagen_chica = 'img/benefits/imagen_chica_1.png';
        }
        if ($data['imagen_titulo'] && $data['imagen_titulo']->move('public/img/benefits/', 'imagen_titulo_1.png'))
        {
            $benefit->imagen_titulo = 'img/benefits/imagen_titulo_1.png';
        }

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
                $counter += $vote->vote;
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

        foreach (self::all() as $model)
        {
            array_push($models, array(
                'id' => $model->id,
                'nombre' => $model->nombre,
                'descripcion' => $model->descripcion,
                'lat' => $model->lat,
                'lng' => $model->lng,
                'rating' => $model->rating
            ));
        }
        $models = array_values(array_sort($models, function($value)
        {
            return -$value['rating'];
        }));
        return $models;
    }

    static public function searchByKeyword($q = null)
    {
        $results = Benefit::where(function($query) use ($q)
        {
            $query->where('nombre', 'LIKE', '%' . $q . '%');
            $query->orWhere('descripcion', 'LIKE', '%' . $q . '%');
            $query->orWhere('tags', 'LIKE', '%' . $q . '%');
        })->get();
        return $results;
    }
} 