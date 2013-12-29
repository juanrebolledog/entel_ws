<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $td_data = array();

    protected $td_headers = array();

    private function prepareForTests()
    {
        Artisan::call('migrate');
        Route::enableFilters();
        Eloquent::unguard();
        $this->seed('UserLevelSeeder');
        $this->seed('UserSeeder');
        $this->seed('CategorySeeder');
        $this->seed('BenefitSeeder');
        $this->seed('EventSeeder');
        Mail::pretend(true);

        $user = User::first();

        $headers = array(
            'HTTP_ENTEL-ACCESS-KEY' => Config::get('app.access_keys')['ios'],
            'HTTP_ENTEL-API-KEY' => $user->api_key
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
