<?php
class BenefitSearchTest extends TestCase {
    public function testBenefitSearch()
    {
        $q = 'Prueba';
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
	    $lat = $this->origin['lat'];
	    $lng = $this->origin['lng'];
	    $user_id = 1;
	    $range = null;
	    $limit = null;
	    $benefits = Benefit::findByLocation($lat, $lng, $user_id, $range, $limit);
	    $this->assertEquals(20, $benefits->count());
	    $benefits->each(function($benefit)
	    {
		    $this->assertTrue(is_array($benefit->locations));
		    foreach ($benefit->locations as $location)
		    {
			    $this->assertTrue(isset($location['distancia']));
			    $this->assertTrue(is_numeric($location['distancia']));
		    }
	    });
    }

    public function testBenefitSearchByCoordinatesNoResults()
    {
	    $lat = 11.8053905;
	    $lng = -69.8457396;
	    $user_id = 1;
	    $range = null;
	    $limit = null;
	    $benefits = Benefit::findByLocation($lat, $lng, $user_id, $range, $limit);
	    $this->assertEquals(0, $benefits->count());
	    $benefits->each(function($benefit)
	    {
		    $this->assertTrue(is_array($benefit->locations));
	    });
    }

    public function testBenefitSearchByCoordinatesNoArguments()
    {

    }
} 