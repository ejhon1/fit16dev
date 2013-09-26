<?php
App::uses('Notesubject', 'Model');

/**
 * Notesubject Test Case
 *
 */
class NotesubjectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notesubject',
		'app.casenote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notesubject = ClassRegistry::init('Notesubject');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notesubject);

		parent::tearDown();
	}

}
