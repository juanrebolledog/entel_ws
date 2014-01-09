<?php
class EventApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testEventIndexPlain()
    {
        $request = $this->request('GET', '/api/events');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testEventIndexWithCoords()
    {
        $request = $this->request('GET', '/api/events?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng']);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testEventIndexWithCoordsOrdering()
    {
        $request = $this->request('GET', '/api/events?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng']);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

        $distances = array();
        foreach ($content->data as $dobj)
        {
            $this->assertTrue(isset($dobj->distancia));
            $this->assertTrue(is_numeric($dobj->distancia) || is_float($dobj->distancia));
            array_push($distances, $dobj->distancia);
        }

        foreach ($distances as $k=>$distance)
        {
            if (!isset($distances[$k + 1]))
            {
                break;
            }
            $this->assertTrue(($distances[$k + 1] - $distances[$k]) >= 0);
        }
    }

    public function testEventShow()
    {
        $last = AppEvent::take(1)->first();
        $request = $this->request('GET', '/api/events/' . $last->id);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertTrue($content->data->id == $last->id);
    }

    public function testEventSearch()
    {
        $request = $this->request('GET', '/api/events/search?q=Prueba');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testEventSearchNoKeyword()
    {
        $request = $this->request('GET', '/api/events/search?q=');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testEventSearchNoResults()
    {
        $request = $this->request('GET', '/api/events/search?q=fijksdoifjiojfis');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testEventComments()
    {
        $event = AppEvent::take(1)->first();
        $request = $this->request('GET', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertTrue($content->status);

        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertEquals($content->data->evento_id, $event->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);
    }

    public function testEventComment()
    {
        $event = AppEvent::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->evento_id, $event->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);
    }

    public function testEventCommentNoData()
    {
        $event = AppEvent::take(1)->first();
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertFalse($content->status);
        $this->assertEquals($content->message, 'Faltan datos');
    }

    public function testEventCommentShare()
    {
        $event = AppEvent::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->evento_id, $event->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_data = array(
            'metodo' => 'twitter'
        );
        $this->setRequestData($share_data);
        $share_request = $this->request('POST', '/api/events/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertTrue($share_content->status);
        $this->assertEquals($share_content->data->compartido_tw, 1);
    }

    public function testEventCommentShareMalformedData()
    {
        $event = AppEvent::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->evento_id, $event->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_data = array(
            'metodo' => 'malformed'
        );
        $this->setRequestData($share_data);
        $share_request = $this->request('POST', '/api/events/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertFalse($share_content->status);
        $this->assertTrue(empty($share_content->data));
    }

    public function testEventCommentShareNoData()
    {
        $event = AppEvent::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/events/' . $event->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->evento_id, $event->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_request = $this->request('POST', '/api/events/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertFalse($share_content->status);
        $this->assertTrue(empty($share_content->data));
    }

}