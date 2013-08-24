<?php
App::uses('Archife', 'Model');

/**
 * Archife Test Case
 *
 */
class ArchifeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.archife'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Archife = ClassRegistry::init('Archife');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Archife);

		parent::tearDown();
	}

}
