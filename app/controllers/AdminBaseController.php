<?php

class AdminBaseController extends Controller {

    protected $layout = 'admin_layout';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    public $api_response = array(
        'data' => array(),
        'status' => false
    );

    public function setApiResponse($response, $status)
    {
        $this->api_response['data'] = $response;
        $this->api_response['status'] = $status;
    }

}