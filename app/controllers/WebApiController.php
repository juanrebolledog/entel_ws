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
	    $pages = Page::getAll();
        $response = array(
	        'zones' => $zones->toArray(),
	        'pages' => $pages->toArray()
        );
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

	public function kb()
	{
		$pages = KBPage::getAll();
		$this->setApiResponse($pages->toArray(), true);
		return Response::json($this->api_response);
	}

    public function events()
    {
        $sub_categories = EventSubCategory::getSubCategories();
		foreach ($sub_categories as $scat)
		{
			foreach ($scat->events as $event)
			{
				$current = false;
				if (!empty($event->dates))
				{
					foreach ($event->dates as $date)
					{
						if ($date->fecha > date('Y-m-d'))
						{
							$current = true;
							break;
						}
					}
				}
				$event->current = $current;
			}
		}
	    foreach ($sub_categories as $scat)
	    {
		    $scat->events = $scat->events->sortBy(function($event)
		    {
			    return $event->current;
		    });
	    }

        $response = $sub_categories->toArray();
        $this->setApiResponse($response, true);
        return Response::json($this->api_response);
    }

    public function benefits()
    {
        $sub_categories = BenefitSubCategory::getSubCategories(null, true);

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

	public function geo()
	{
		$regions = Region::getRegions();
		$this->setApiResponse($regions->toArray(), true);
		return Response::json($this->api_response);
	}

	public function search()
	{
		$q = Input::get('q');
		if ($q)
		{
			$benefits = Benefit::searchByKeyword($q);
			$this->setApiResponse($benefits->toArray(), true);
			return Response::json($this->api_response);
		}
	}
}