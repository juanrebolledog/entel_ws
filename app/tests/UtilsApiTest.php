<?php
class UtilsApiTest extends TestCase {
    public function testCalculateDistance()
    {

        $expected = 93701.0;
        $distance = LocationModel::calculateDistance($this->origin, $this->dest);
        $this->assertTrue(is_float($distance));
        $this->assertEquals(round($expected), round($distance));
    }
} 