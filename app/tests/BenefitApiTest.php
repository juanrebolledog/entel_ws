<?php
class BenefitApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testBenefitIndexPlain()
    {
        $request = $this->request('GET', '/api/benefits');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitIndexWithCoords()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng']);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitIndexWithCoordsOrdering()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng']);
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
            $this->assertTrue(($distances[$k + 1] - $distances[$k]) > 0);
        }
    }

    public function testBenefitShow()
    {
        $last = Benefit::take(1)->first();
        $request = $this->request('GET', '/api/benefits/' . $last->id);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertTrue($content->data->id == $last->id);
    }

    public function testBenefitSearch()
    {
        $request = $this->request('GET', '/api/benefits/search?q=sad');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitSearchNoKeyword()
    {
        $request = $this->request('GET', '/api/benefits/search?q=');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitSearchNoResults()
    {
        $request = $this->request('GET', '/api/benefits/search?q=fijksdoifjiojfis');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitRanking()
    {
        $request = $this->request('GET', '/api/benefits/ranking');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitVote()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'vote' => 10
        );
        $expected = array(
            'vote' => 10,
            'id' => $benefit->id
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals($content->data, (object)$expected);
        $this->assertTrue($content->status);

        $ranking_request = $this->request('GET', '/api/benefits/ranking');
        $ranking_content = json_decode($ranking_request->getContent());

        foreach ($ranking_content->data as $rbenefit)
        {
            if ($benefit->id == $rbenefit->id)
            {
                $this->assertEquals($rbenefit->rating, $data['vote']);
            }
        }
    }

    public function testBenefitIgnore()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/ignore');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

        $index_request = $this->request('GET', '/api/benefits');
        $index_content = json_decode($index_request->getContent());

        foreach ($index_content->data as $rbenefit)
        {
            if ($benefit->id == $rbenefit->id)
            {
                // if this fails then the search result contained the ignored benefit.
                $this->assertFalse($rbenefit->id);
            }
        }
    }

    public function testBenefitComments()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('GET', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertTrue($content->status);

        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertEquals($content->data->beneficio_id, $benefit->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);
    }

    public function testBenefitComment()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->beneficio_id, $benefit->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);
    }

    public function testBenefitCommentNoData()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertFalse($content->status);
        $this->assertEquals($content->message, 'Faltan datos');
    }

    public function testBenefitCommentShare()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->beneficio_id, $benefit->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_data = array(
            'metodo' => 'twitter'
        );
        $this->setRequestData($share_data);
        $share_request = $this->request('POST', '/api/benefits/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertTrue($share_content->status);
        $this->assertEquals($share_content->data->compartido_tw, 1);
    }

    public function testBenefitCommentShareMalformedData()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->beneficio_id, $benefit->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_data = array(
            'metodo' => 'malformed'
        );
        $this->setRequestData($share_data);
        $share_request = $this->request('POST', '/api/benefits/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertFalse($share_content->status);
        $this->assertTrue(empty($share_content->data));
    }

    public function testBenefitCommentShareNoData()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'mensaje' => 'Test comment'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->beneficio_id, $benefit->id);
        $this->assertEquals($content->data->mensaje, $data['mensaje']);

        $share_request = $this->request('POST', '/api/benefits/comments/' . $content->data->id . '/share');
        $share_content = json_decode($share_request->getContent());
        $this->assertFalse($share_content->status);
        $this->assertTrue(empty($share_content->data));
    }

}