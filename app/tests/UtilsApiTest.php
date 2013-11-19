<?php
class UtilsApiTest extends TestCase {
    public function testCalculateDistance()
    {
        $origin = array(
            'lat' => 10.1010,
            'lng' => -69.1234
        );
        $dest = array(
            'lat' => 10.2020,
            'lng' => -69.2468
        );
        $expected = 17556.1632205;
        $distance = LocationModel::calculateDistance($origin, $dest);
        $this->assertTrue(is_float($distance));
        $this->assertTrue(round($expected) == round($distance));
    }
} 