<?php

class EventsSubCategoriesController extends \BaseController {

    public function index()
    {
        // Here we get the first category from events. Only one because for now and the forseeable
        // future, there will be only one category for Events.
        $category = EventCategory::first();
        if ($category)
        {
            $category = $category->toArray();
            $sub_categories = EventSubCategory::with('events')->where('categoria_id', $category['id'])->get();
            if ($sub_categories)
            {
                foreach ($sub_categories as &$sub)
                {
                    foreach ($sub->events as $event)
                    {
                        $event->prepareForWS();
                    }
                }
                $category['sub_categories'] = $sub_categories->toArray();
            }
            $this->setApiResponse($category, true);
        }
        else
        {
            $this->setApiResponse(array(), true);
        }
        return Response::json($this->api_response);
    }

}