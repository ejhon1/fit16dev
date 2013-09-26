<?php
App::uses('Docnote', 'Model');

/**
 * Docnote Test Case
 *
 */
class DocnoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.docnote',
		'app.document',
		'app.user',
		'app.casenote',
		'app.clientcase',
		'app.archive',
		'app.status',
		'app.applicant',
		'app.address',
		'app.country',
		'app.casestatus',
		'app.notesubject',
		'app.employee'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Docnote = ClassRegistry::init('Docnote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Docnote);

		parent::tearDown();
	}

}
