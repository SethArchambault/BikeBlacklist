<?php 
class BikeTest extends TestCase {
	
	public function testBike()
	{
		$this->call('GET', 'bikes');
		$this->assertResponseOk();
	}

}