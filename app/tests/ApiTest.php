<?php
class ApiTest extends TestCase {
    public function setUp()
    {
        parent::setUp();
    }

    public function testResponseContentType()
    {
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals('application/json', $req->headers->get('content-type'));
    }

    public function testResponseResponseOk()
    {
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals(200, $req->getStatusCode());
    }
}
 