<?php 

use App\Models\Bike;

class BikeTest extends TestCase {
	
	public function testBike()
	{
		$this->call('GET', '/');
		$this->assertResponseOk();
	}

	public function testMoreDetails() {
		$this->call('GET', '/more-details');
		$this->assertResponseOk();
	}

	public function testGetBikeId()
	{
        $bike = new Bike;
        $bike->description = "Testing";
        $bike->save();
        $this->assertEquals($bike->description, "Testing");
        $this->assertTrue(is_null($bike->test));
        $this->assertTrue(!is_null($bike->id));
        $this->assertTrue(is_int($bike->id));
        $bike->delete();

	}

}