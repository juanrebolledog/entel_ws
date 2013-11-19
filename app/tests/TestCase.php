<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $td_data = array();

    protected $td_headers = array();

    public function setUp()
    {
        parent::setUp();
        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => Config::get('app.access_keys')['ios'],
            'HTTP_ENTEL-API-KEY' => 'dd4bbd802d0c72fe3a14b0fc365379ee1939600245705ae1ce551f5967216290'
        );
        $this->setRequestHeaders($headers);
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 't';

        return require __DIR__.'/../../bootstrap/start.php';
    }

    public function setRequestHeaders($headers)
    {
        $this->td_headers = $headers;
    }

    public function setRequestData($data)
    {
        $this->td_data = $data;
    }

    public function request($method, $uri)
    {
        return $this->call($method, $uri, $this->td_data, array(), $this->td_headers);
    }

}
