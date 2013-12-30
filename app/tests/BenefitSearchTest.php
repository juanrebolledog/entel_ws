<?php
class BenefitSearchTest extends TestCase {
    public function testBenefitSearch()
    {
        $q = 'feeling';
        $results = Benefit::searchByKeyword($q);
        $this->assertNotEquals(count($results), 0);
    }

    public function testBenefitSearchNoResults()
    {
        $q = 'ckvfpmogfpo';
        $results = Benefit::searchByKeyword($q);
        $this->assertEquals(count($results), 0);

    }

    public function testBenefitSearchNoArguments()
    {
        $results = Benefit::searchByKeyword();
        $this->assertNotEquals(count($results), 0);
    }

    public function testBenefitSearchByCoordinates()
    {

    }

    public function testBenefitSearchByCoordinatesNoResults()
    {

    }

    public function testBenefitSearchByCoordinatesNoArguments()
    {

    }
} 