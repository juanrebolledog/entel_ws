<?php
class BenefitCommentsController extends BaseController {
    public function show($benefit_id)
    {
        $benefit = Benefit::find($benefit_id);
        if ($benefit)
        {
            $comments = BenefitComment::with('user')->where('beneficio_id', $benefit->id)->get();
            $comments_array = $comments->toArray();
            $this->setApiResponse($comments_array, true);
            return Response::json($this->api_response);
        }
        $this->setApiResponse(false, false);
        return Response::json($this->api_response);
    }

    public function store($benefit_id)
    {
        $benefit = Benefit::find($benefit_id);
        $data = Input::all();
        if ($benefit)
        {
            $comment = new BenefitComment();
            $comment->beneficio_id = $benefit_id;
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

    public function share($id)
    {
        $method = Input::get('metodo');
        if (!$method)
        {
            $this->setApiResponse(false, false, 'Datos faltantes: metodo');
            return Response::json($this->api_response);
        }
        $share = BenefitComment::saveShare($id, Auth::getUser()->id, $method);
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