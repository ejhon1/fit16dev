<?php
App::uses('Casenote', 'Model');

/**
 * Casenote Test Case
 *
 */
class CasenoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.casenote',
		'app.clientcase',
		'app.user',
		'app.docnote',
		'app.employee',
		'app.notesubject'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Casenote = ClassRegistry::init('Casenote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Casenote);

		parent::tearDown();
	}

}
