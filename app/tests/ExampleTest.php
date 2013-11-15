<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('POST', '/api/benefits/1/ignore');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

}