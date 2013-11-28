<?php
class UtilsApiTest extends TestCase {
    public function testCalculateDistance()
    {

        $expected = 17556.1632205;
        $distance = LocationModel::calculateDistance($this->origin, $this->dest);
        $this->assertTrue(is_float($distance));
        $this->assertTrue(round($expected) == round($distance));
    }
} 