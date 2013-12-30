<?php
class UserLevel extends BaseModel {
    protected $table = 'usuarios_niveles';
    public $timestamps = false;

    static public function getLevels()
    {
        return self::all()->each(function($level)
        {
            $level->prepareForWS();
        });
    }

    static public function getLevel($id)
    {
        $level = self::find($id);
        if ($level && $level->exists)
        {
            $level->prepareForWS();
            return $level;
        }
        return false;
    }

    public function prepareForWS()
    {
        $this->imagen_on = asset($this->imagen_on);
        $this->imagen_off = asset($this->imagen_off);
    }
} 