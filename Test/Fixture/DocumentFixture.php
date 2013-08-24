<?php
/**
 * DocumentFixture
 *
 */
class DocumentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'archive_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'applicant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'ancestortype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'documenttype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'filename' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'filesize' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'filemime' => array('type' => 'string', 'null' => false, 'default' => 'text/plain', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'archive_id' => array('column' => 'archive_id', 'unique' => 0),
			'applicant_id' => array('column' => 'applicant_id', 'unique' => 0),
			'ancestortype_id' => array('column' => 'ancestortype_id', 'unique' => 0),
			'documenttype_id' => array('column' => 'documenttype_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'archive_id' => 1,
			'applicant_id' => 1,
			'ancestortype_id' => 1,
			'documenttype_id' => 1,
			'filename' => 'Lorem ipsum dolor sit amet',
			'filesize' => 1,
			'filemime' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-08-24 04:44:07'
		),
	);

}
