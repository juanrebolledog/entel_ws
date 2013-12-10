<?php
class BenefitCommentsController extends BaseController {
    public function show($benefit_id)
    {
        $benefit = Benefit::find($benefit_id);
        if ($benefit)
        {
            $comments = BenefitComment::where('beneficio_id', $benefit->id)->get();
            $this->setApiResponse($comments->toArray(), true);
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
} 