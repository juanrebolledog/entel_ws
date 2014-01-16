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
    }

    public function testEventCategoriesShow()
    {
        $request = $this->request('GET', '/api/events/category');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

	    foreach ($content->data->sub_categories as $sub_cat)
	    {
		    $this->assertEquals(1, preg_match('/^http|https*/', $sub_cat->icono));
		    $this->assertEquals(1, preg_match('/^http|https*/', $sub_cat->banner));

		    $this->assertTrue(isset($sub_cat->events));

		    foreach ($sub_cat->events as $event)
		    {
			    $this->assertEquals(1, preg_match('/^http|https*/', $event->imagen_grande_web));
			    $this->assertEquals(1, preg_match('/^http|https*/', $event->imagen_grande));
			    $this->assertEquals(1, preg_match('/^http|https*/', $event->imagen_chica));
			    $this->assertEquals(1, preg_match('/^http|https*/', $event->imagen_titulo));
			    $this->assertEquals(1, preg_match('/^http|https*/', $event->icono));
		    }
	    }
    }
}