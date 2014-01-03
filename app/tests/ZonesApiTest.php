<?php
class ZonesApiTest extends TestCase {
    public function setUp()
    {
        parent::setUp();
    }

    public function testZonesIndex()
    {
        $req = $this->request('GET', '/api/zones');
        $content = json_decode($req->getContent());
        $this->assertTrue($content->status);
        $this->assertTrue(!empty($content->data));
    }

    public function testZonesShow()
    {
        $req = $this->request('GET', '/api/zones');
        $content = json_decode($req->getContent());
        $this->assertTrue($content->status);
        $this->assertTrue(!empty($content->data));

        foreach ($content->data as $zone)
        {
            $s_req = $this->request('GET', '/api/zones/' . $zone->id);
            $s_content = json_decode($s_req->getContent());
            $this->assertTrue($s_content->status);
            $this->assertTrue(!empty($s_content->data));
            $this->assertEquals(1, preg_match('/^http|https*/', $s_content->data->imagen));
        }
    }

    public function testZonesShowUnknown()
    {
        $s_req = $this->request('GET', '/api/zones/99');
        $s_content = json_decode($s_req->getContent());
        $this->assertFalse($s_content->status);
        $this->assertTrue(empty($s_content->data));
    }
}
 