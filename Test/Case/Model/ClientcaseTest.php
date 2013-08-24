<?php
App::uses('Clientcase', 'Model');

/**
 * Clientcase Test Case
 *
 */
class ClientcaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.document',
		'app.casestatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Clientcase = ClassRegistry::init('Clientcase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Clientcase);

		parent::tearDown();
	}

}
