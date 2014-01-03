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

    public function testResponseForbidden()
    {
        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => Config::get('app.access_keys')['ios'],
            'HTTP_ENTEL-API-KEY' => 'wrong'
        );

        $this->setRequestHeaders($headers);
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals(403, $req->getStatusCode());
    }
}
 