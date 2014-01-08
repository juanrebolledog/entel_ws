<?php
class WebApiController extends BaseController {
    public function home()
    {
        $this->setApiResponse(array(
            'slider' => array(
                array(
                    'image_lg' => '//placehold.it/800x200.png',
                    'image_sm' => '//placehold.it/64x64.png',
                    'name' => 'Slider Test Element'
                ),
                array(
                    'image_lg' => '//placehold.it/800x200.png',
                    'image_sm' => '//placehold.it/64x64.png',
                    'name' => 'Slider Test Element'
                ),
                array(
                    'image_lg' => '//placehold.it/800x200.png',
                    'image_sm' => '//placehold.it/64x64.png',
                    'name' => 'Slider Test Element'
                ),
                array(
                    'image_lg' => '//placehold.it/800x200.png',
                    'image_sm' => '//placehold.it/64x64.png',
                    'name' => 'Slider Test Element'
                )
            ),
            'zones' => array(
                array(
                    'image_lg' => '//placehold.it/300x150.png',
                    'name' => 'Zone Test'
                ),
                array(
                    'image_lg' => '//placehold.it/300x150.png',
                    'name' => 'Zone Test'
                )
            ),
            'events' => array(
                array(
                    'image_lg' => '//placehold.it/300x150.png',
                    'name' => 'Event Test'
                )
            ),
            'benefits' => array(
                array(
                    'image_lg' => '//placehold.it/300x150.png',
                    'name' => 'Benefit Test'
                )
            )
        ), true);
        return Response::json($this->api_response);
    }

    public function zones()
    {
        $response = array(
            'categories' => array(
                array(
                    'name' => 'Cat 1',
                    'zones' => array(
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        )
                    )
                ),
                array(
                    'name' => 'Cat 2',
                    'zones' => array(
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        ),
                        array(
                            'image_sm' => '//placehold.it/100x90.png',
                            'amount' => 1000,
                            'name' => 'Zone Test'
                        )
                    )
                )
            )
        );
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function events()
    {
        $sub_categories = EventSubCategory::getSubCategories();

        $response = $sub_categories->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function benefits()
    {
        $response = array();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function contests()
    {
        $response = array();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function socials()
    {
        $response = array();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }
}