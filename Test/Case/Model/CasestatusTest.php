<?php
App::uses('Casestatus', 'Model');

/**
 * Casestatus Test Case
 *
 */
class CasestatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.casestatus',
		'app.clientcase',
		'app.user',
		'app.casenote',
		'app.notesubject',
		'app.docnote',
		'app.employee',
		'app.archive',
		'app.status',
		'app.applicant',
		'app.address',
		'app.country',
		'app.document'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Casestatus = ClassRegistry::init('Casestatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Casestatus);

		parent::tearDown();
	}

}
