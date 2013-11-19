<?php
class BenefitApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->td_headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => Config::get('app.access_keys')['ios'],
            'HTTP_ENTEL-API-KEY' => 'dd4bbd802d0c72fe3a14b0fc365379ee1939600245705ae1ce551f5967216290'
        );
    }

    public function testBenefitIndexPlain()
    {
        $crawler = $this->call('GET', '/api/benefits', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content));
        $this->assertTrue($content->status);
    }

    public function testBenefitIndexWithCoords()
    {
        $crawler = $this->call('GET', '/api/benefits?lat=10.1010&lng=-69.1234', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitIndexWithCoordsOrdering()
    {
        $crawler = $this->call('GET', '/api/benefits?lat=10.1010&lng=-69.1234', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

        $distances = array();
        foreach ($content->data as $dobj)
        {
            $this->assertTrue(isset($dobj->distance) && is_float($dobj->distance));
            array_push($distances, $dobj->distance);
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
        $crawler = $this->call('GET', '/api/benefits/1', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertTrue($content->data->id == 1);
    }

    public function testBenefitSearch()
    {
        $crawler = $this->call('GET', '/api/benefits/search?q=Pizza', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitSearchNoKeyword()
    {
        $crawler = $this->call('GET', '/api/benefits/search?q=', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitRanking()
    {
        $crawler = $this->call('GET', '/api/benefits/ranking', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitVote()
    {
        $data = array(
            'vote' => 10
        );
        $expected = array(
            'vote' => 10,
            'id' => 1
        );
        $crawler = $this->call('POST', '/api/benefits/1/vote', $data, array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals($content->data, (object)$expected);
        $this->assertTrue($content->status);
    }

    public function testBenefitIgnore()
    {
        $crawler = $this->call('POST', '/api/benefits/1/ignore', array(), array(), $this->td_headers);
        $content = json_decode($crawler->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

}