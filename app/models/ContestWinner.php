<?php
class ContestWinner extends BaseModel {

    protected $table = 'concursos_ganadores';

    public $timestamps = false;

    static public $rules = array(
        'nombres' => 'required',
        'rut' => 'required'
    );

    public function contest()
    {
        return $this->belongsTo('Contest', 'concurso_id');
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

    static public function getWinner($id)
    {
        if ($id)
        {
            $winner = self::with('contest')->find($id);
            if ($winner && $winner->exists)
            {
                return $winner;
            }
        }
        return false;
    }

    static public function getWinners()
    {
        return self::with('contest')->get();
    }

    static public function createContest($data)
    {
        $winner = new self();
        $winner->nombres = $data['nombres'];
        $winner->rut = $data['rut'];

        $winner->save();
        return $winner;
    }

    static public function updateContest($id, $data)
    {
        $winner = self::find($id);
        $winner->nombres = $data['nombres'];
        $winner->rut = $data['rut'];

        $winner_array = $winner->toArray();
        $winner_validator = Validator::make($winner_array, self::$validation);
        if ($winner_validator->fails())
        {
            return $winner;
        }
        else
        {
            if ($winner->save())
            {
                $winner->validator = $winner_validator;
                return $winner;
            }
        }
    }
} 