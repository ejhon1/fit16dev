<?php
App::uses('Documenttype', 'Model');

/**
 * Documenttype Test Case
 *
 */
class DocumenttypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.documenttype',
		'app.document'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Documenttype = ClassRegistry::init('Documenttype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Documenttype);

		parent::tearDown();
	}

}
