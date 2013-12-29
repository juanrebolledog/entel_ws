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
            if (!empty($data))
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
            else
            {
                $this->setApiResponse(false, false, 'Faltan datos');
                return Response::json($this->api_response);
            }
        }
        $this->setApiResponse(false, false);
        return Response::json($this->api_response);
    }

    public function share($id)
    {
        $method = Input::get('metodo');
        if (!$method)
        {
            $this->setApiResponse(false, false, 'Datos faltantes: metodo');
            return Response::json($this->api_response);
        }
        $share = EventComment::saveShare($id, Auth::getUser()->id, $method);
        if ($share)
        {
            $this->setApiResponse($share->toArray(), true);
        }
        else
        {
            $this->setApiResponse(array(), false);
        }
        return Response::json($this->api_response);
    }
} 