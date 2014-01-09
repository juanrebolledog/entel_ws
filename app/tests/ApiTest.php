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

    public function testResponseForbiddenWhenUnknownApiKey()
    {
        $access_keys = Config::get('app.access_keys');
        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => $access_keys['ios'],
            'HTTP_ENTEL-API-KEY' => 'wrong'
        );

        $this->setRequestHeaders($headers);
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals(403, $req->getStatusCode());
    }

    public function testResponseForbiddenWhenMissingApiKey()
    {
        $access_keys = Config::get('app.access_keys');
        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => $access_keys['ios'],
        );

        $this->setRequestHeaders($headers);
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals(403, $req->getStatusCode());
    }

    public function testResponseForbiddenWhenMissingHeaders()
    {
        $this->setRequestHeaders(array());
        $req = $this->request('GET', '/api/benefits');
        $this->assertEquals(403, $req->getStatusCode());
    }
}
 