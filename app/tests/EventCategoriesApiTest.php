<?php
class EventCategoriesApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testEventCategoriesIndex()
    {
        $request = $this->request('GET', '/api/events/category');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertTrue(isset($content->data->sub_categories));

        foreach ($content->data->sub_categories as $sub_cat)
        {
            $this->assertTrue(isset($sub_cat->id));
        }
    }
}