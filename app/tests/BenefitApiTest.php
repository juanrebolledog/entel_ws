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
            $this->assertTrue(($distances[$k + 1] - $distances[$k]) >= 0);
        }
    }

    public function testBenefitIndexWithLimit()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng'] . '&limit=1');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        $this->assertEquals(count($content->data), 1);
    }

    public function testBenefitIndexWithRange()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng'] . '&range=20000');
        $content = json_decode($request->getContent());
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertTrue($benefit->distancia <= 20000);
        }
    }

    public function testBenefitIndexBenefitsHaveSubCategory()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng'] . '');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertTrue(isset($benefit->sub_category));
            $this->assertTrue(!empty($benefit->sub_category));
        }
    }

    public function testBenefitIndexWithoutParamsBenefitsHaveSubCategory()
    {
        $request = $this->request('GET', '/api/benefits');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertTrue(isset($benefit->sub_category));
            $this->assertTrue(!empty($benefit->sub_category));
        }
    }

    public function testBenefitIndexBenefitsHaveCommentsKey()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng'] . '');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertTrue(isset($benefit->comments));
        }
    }

    public function testBenefitIndexBenefitsResourcesAreUrls()
    {
        $request = $this->request('GET', '/api/benefits?lat=' . $this->origin['lat'] . '&lng=' . $this->origin['lng'] . '');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_grande));
            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_chica));
            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_titulo));
            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->icono));

            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->sub_category->banner));
            $this->assertEquals(1, preg_match('/^http|https*/', $benefit->sub_category->icono));
        }
    }

    public function testBenefitIndexWithoutParamsBenefitsHaveCommentsKey()
    {
        $request = $this->request('GET', '/api/benefits');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        foreach ($content->data as $benefit)
        {
            $this->assertTrue(isset($benefit->comments));
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

    public function testBenefitShowResourcesAreUrls()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('GET', '/api/benefits/' . $benefit->id);
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($benefit->id, $content->data->id);
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->imagen_grande_web));
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->imagen_grande));
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->imagen_chica));
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->imagen_titulo));
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->icono));

        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->sub_category->banner));
        $this->assertEquals(1, preg_match('/^http|https*/', $content->data->sub_category->icono));
    }

    public function testBenefitSearch()
    {
        $request = $this->request('GET', '/api/benefits/search?q=Prueba');
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
            'vote' => 5
        );
        $expected = array(
            'vote' => 5,
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

    public function testBenefitVoteNoData()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertFalse($content->status);
    }

    public function testBenefitVoteWrongDataKeys()
    {
        $data = array(
            'value' => 5
        );
        $this->setRequestData($data);
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertFalse($content->status);
    }

    public function testBenefitVoteWrongVoteValue()
    {
        $data = array(
            'vote' => 'nope'
        );
        $this->setRequestData($data);
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertFalse($content->status);
    }

    public function testBenefitVoteMoreThanMax()
    {
        $data = array(
            'vote' => 6
        );
        $this->setRequestData($data);
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals(5, $content->data->vote);
        $this->assertTrue($content->status);
    }

    public function testBenefitVoteLessThanMin()
    {
        $data = array(
            'vote' => 0
        );
        $this->setRequestData($data);
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/vote');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals(1, $content->data->vote);
        $this->assertTrue($content->status);
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

    public function testBenefitRedeem()
    {
        $benefit = Benefit::with('locations')->take(1)->first();
	    $one_location = $benefit->locations[0];
        $data = array(
            'lat' => $one_location->lat,
            'lng' => $one_location->lng
        );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertTrue($cont->status);
        $this->assertTrue($cont->data->redeemed);
    }

    public function testBenefitRedeemTooFar()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'lat' => 0,
            'lng' => 0
        );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertFalse($cont->status);
    }

    public function testBenefitRedeemMalformedData()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'lat' => 'lat',
            'lng' => 'lng'
        );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertFalse($cont->status);
    }

    public function testBenefitRedeemMalformedKeys()
    {
        $benefit = Benefit::take(1)->first();
        $data = array(
            'lt' => 0,
            'lg' => 0
        );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertFalse($cont->status);
    }

    public function testBenefitRedeemNoData()
    {
        $benefit = Benefit::take(1)->first();
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertFalse($cont->status);
    }

    public function testBenefitRedeemUnknown()
    {
        $req = $this->request('POST', '/api/benefits/9001/redeem');
        $cont = json_decode($req->getContent());
        $this->assertFalse($cont->status);
    }

    public function testBenefitRedeemTwice()
    {
        $benefit = Benefit::with('locations')->take(1)->first();
	    $one_location = $benefit->locations[0];
        $data = array(
            'lat' => $one_location->lat,
            'lng' => $one_location->lng
        );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertTrue($cont->status);
        $this->assertTrue($cont->data->redeemed);

	    $data = array(
		    'lat' => $one_location->lat,
		    'lng' => $one_location->lng
	    );
        $this->setRequestData($data);
        $req = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
        $cont = json_decode($req->getContent());
        $this->assertTrue($cont->status);
        $this->assertTrue($cont->data->redeemed);
    }
}