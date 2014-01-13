<?php
class WebApiController extends BaseController {
    public function home()
    {
        $this->setApiResponse(array(
            'slider' => array(
                array_merge(Zone::random(2)->toArray(),
                AppEvent::random()->toArray(),
                Benefit::random()->toArray())
            ),
            'zones' => array(
                Zone::random(2)->toArray()
            ),
            'events' => array(
                AppEvent::random()->toArray()
            ),
            'benefits' => array(
                Benefit::random()->toArray()
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