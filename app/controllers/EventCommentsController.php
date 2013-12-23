<?php
class EventCommentsController extends BaseController {
    public function show($event_id)
    {
        $event = AppEvent::find($event_id);
        if ($event)
        {
            $comments = EventComment::with('user')->where('evento_id', $event->id)->get();
            $this->setApiResponse($comments->toArray(), true);
            return Response::json($this->api_response);
        }
        $this->setApiResponse(false, false);
        return Response::json($this->api_response);
    }

    public function store($event_id)
    {
        $event = AppEvent::find($event_id);
        $data = Input::all();
        if ($event)
        {
            $comment = new EventComment();
            $comment->evento_id = $event_id;
            $comment->usuario_id = Auth::getUser()->id;
            $comment->mensaje = $data['mensaje'];
            if ($comment->save())
            {
                $this->setApiResponse($comment->toArray(), true);
                return Response::json($this->api_response);
            }
        }
        $this->setApiResponse(false, false);
        return Response::json($this->api_response);
    }
} 