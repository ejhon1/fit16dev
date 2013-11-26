<?php
/**
 * ArchifeFixture
 *
 */
class ArchifeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'archive_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 16, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'family_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 56, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'file_status' => array('type' => 'string', 'null' => false, 'default' => 'Shelf', 'length' => 16, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'archive_name' => 'Lorem ipsum do',
			'family_name' => 'Lorem ipsum dolor sit amet',
			'file_status' => 'Lorem ipsum do',
			'created' => '2013-08-24 04:39:11',
			'modified' => '2013-08-24 04:39:11'
		),
	);

}
