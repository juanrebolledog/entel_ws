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
        $this->assertTrue(!empty($content));
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
            $this->assertTrue(isset($dobj->distancia) && is_float($dobj->distancia));
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

    public function testBenefitRanking()
    {
        $request = $this->request('GET', '/api/benefits/ranking');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function BenefitVote()
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
    }

    public function BenefitIgnore()
    {
        $benefit = Benefit::take(1)->first();
        $request = $this->request('POST', '/api/benefits/' . $benefit->id . '/ignore');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

}