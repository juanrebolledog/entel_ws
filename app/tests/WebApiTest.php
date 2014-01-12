<?php
class WebApiTest extends TestCase {
    public function setUp()
    {
        parent::setUp();
    }

    public function testHomeResponse()
    {
        $req = $this->request('GET', '/web/home');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testZonesResponse()
    {
        $req = $this->request('GET', '/web/zones');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testEventsResponse()
    {
        $req = $this->request('GET', '/web/events');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testBenefitResponse()
    {
        $req = $this->request('GET', '/web/benefits');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testSocialsResponse()
    {
        $req = $this->request('GET', '/web/socials');
        $cnt = json_decode($req->getContent());
        $this->assertTrue($cnt->status);
    }

    public function testContestsResponse()
    {
        $req = $this->request('GET', '/web/contests');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testContestsResponseContainsImageUrls()
    {
        $req = $this->request('GET', '/web/contests');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
        foreach ($cnt->data as $contest)
        {
            $this->assertEquals(1, preg_match('/^http|https*/', $contest->imagen_banner));
        }
    }

    public function testSummerResponse()
    {
        $req = $this->request('GET', '/web/summer');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
    }

    public function testSummerResponseContainsImageUrls()
    {
        $req = $this->request('GET', '/web/summer');
        $cnt = json_decode($req->getContent());
        $this->assertTrue(!empty($cnt->data));
        $this->assertTrue($cnt->status);
        foreach ($cnt->data as $summer_cat)
        {
            foreach ($summer_cat->summers as $summer)
            {
                $this->assertEquals(1, preg_match('/^http|https*/', $summer->imagen_descripcion));
                $this->assertEquals(1, preg_match('/^http|https*/', $summer->imagen_titulo));
            }
        }
    }
}