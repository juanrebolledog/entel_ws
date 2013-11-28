<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $td_data = array();

    protected $td_headers = array();

    private function prepareForTests()
    {
        Route::enableFilters();
        Eloquent::unguard();
        $this->seed('CategorySeeder');
        $this->seed('BenefitSeeder');
        Mail::pretend(true);
        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => Config::get('app.access_keys')['ios'],
            'HTTP_ENTEL-API-KEY' => 'dd4bbd802d0c72fe3a14b0fc365379ee1939600245705ae1ce551f5967216290'
        );
        $this->setRequestHeaders($headers);
        $this->origin = array(
            'lat' => 10.1010,
            'lng' => -69.1234
        );
        $this->dest = array(
            'lat' => 10.2020,
            'lng' => -69.2468
        );
    }

    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

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
