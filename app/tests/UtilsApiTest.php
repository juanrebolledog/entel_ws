<?php
class UtilsApiTest extends TestCase {
    public function testCalculateDistance()
    {

        $expected = 90676.690536432;
        $distance = LocationModel::calculateDistance($this->origin, $this->dest);
        $this->assertTrue(is_float($distance));
        $this->assertTrue(round($expected) == round($distance));
    }
} 