<?php
class EventVideo extends BaseModel {

    protected $table = 'eventos_videos';

    protected $hidden = array(
        'created_at', 'updated_at'
    );

    static public $rules = array(
        'url' => 'required',
        'descripcion' => 'required'
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

    static public function getVideo($id)
    {
        if ($id)
        {
            $video = self::with('event')->find($id);
            if ($video && $video->exists)
            {
                return $video;
            }
        }
        return false;
    }

    static public function getVideos()
    {
        return self::with('event')->get();
    }

    static public function createVideo($data)
    {
        $video = new self();
        $video->url = $data['url'];
        $video->descripcion = $data['descripcion'];

        $video->save();
        return $video;
    }

    static public function updateVideo($id, $data)
    {
        $video = self::find($id);
        $video->url = $data['url'];
        $video->descripcion = $data['descripcion'];

        $video_array = $video->toArray();
        $video_validator = Validator::make($video_array, self::$validation);
        if ($video_validator->fails())
        {
            return $video;
        }
        else
        {
            if ($video->save())
            {
                $video->validator = $video_validator;
                return $video;
            }
        }
    }
} 