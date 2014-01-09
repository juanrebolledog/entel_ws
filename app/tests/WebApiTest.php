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
        $this->assertTrue($cnt->status);
    }
}