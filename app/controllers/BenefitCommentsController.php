<?php
class BenefitCommentsController extends BaseController {
    public function show($benefit_id)
    {
        $benefit = Benefit::find($benefit_id);
        if ($benefit)
        {
            $comments = BenefitComment::where('benefit_id', $benefit->id)->get();
            $this->setApiResponse($comments, true);
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
            $comment->benefit_id = $benefit_id;
            $comment->user_id = Auth::getUser()->id;
            $comment->text = $data['text'];
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