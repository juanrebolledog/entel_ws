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
        $zones = ZoneCategory::getCategories();
        $response = $zones->toArray();
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
        $sub_categories = BenefitSubCategory::getSubCategories();

        $response = $sub_categories->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function contests()
    {
        $contests = Contest::getContests();
        $response = $contests->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function socials()
    {
        $galleries = SocialGallery::getGalleries();
        $response = $galleries->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function summer()
    {
        $galleries = SummerCategory::getCategories();
        $response = $galleries->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }
}