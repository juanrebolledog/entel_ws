<?php

class EventIgnore extends BaseModel {
    protected $table = 'event_ignored';
    public $timestamps = false;
    static public function saveIgnore($event_id, $user_id)
    {
        $event_query = EventIgnore::where('user_id', '=', $user_id);
        $event = $event_query->first();
        if (!$event)
        {
            $event = new EventIgnore();
            $event->user_id = $user_id;
            $event->event_id = $event_id;
            $event->created_at = date('Y-m-d H:i:s');
            $event->save();
            return true;
        }
        return $event_query->delete();
    }
} 