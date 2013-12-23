<?php

class AdminBenefitVotesController extends AdminBaseController {

    protected $layout = 'admin_layout';

    public function __construct()
    {
        $this->beforeFilter(function()
        {
            View::share('data', array('current' => 'ratings'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $votes = BenefitVote::getVotes();
        return $this->layout->content = View::make('admin_votes.index')->with(array('votes' => $votes));
    }

    public function show($benefit_id)
    {
        $benefit = Benefit::find($benefit_id);
        $votes = BenefitVote::getVotes($benefit_id);
        return $this->layout->content = View::make('admin_votes.show')->with(array('votes' => $votes, 'benefit' => $benefit));
    }

}