<?php
App::uses('Document', 'Model');

/**
 * Document Test Case
 *
 */
class DocumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.document',
		'app.archive',
		'app.applicant',
		'app.clientcase',
		'app.user',
		'app.casenote',
		'app.notesubject',
		'app.docnote',
		'app.employee',
		'app.status',
		'app.casestatus',
		'app.address',
		'app.country',
		'app.ancestortype',
		'app.documenttype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Document = ClassRegistry::init('Document');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Document);

		parent::tearDown();
	}

}
