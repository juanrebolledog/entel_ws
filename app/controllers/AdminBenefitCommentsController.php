<?php

class AdminBenefitCommentsController extends AdminBaseController {

    protected $layout = 'admin_layout';

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'comments'));
        });
    }

    public function index()
    {
        $comments = BenefitComment::with('user', 'benefit')->get();
        return $this->layout->content = View::make('admin_comments.index')->with(array('comments' => $comments));
    }

    public function show($id)
    {
        $comment = BenefitComment::with('user', 'benefit', 'shared')->find($id);
        return $this->layout->content = View::make('admin_comments.show')->with(array('comment' => $comment));
    }

}