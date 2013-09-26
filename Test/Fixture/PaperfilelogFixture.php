<?php
/**
 * PaperfilelogFixture
 *
 */
class PaperfilelogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'archive_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'date_borrowed' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_returned' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'archive_id' => array('column' => 'archive_id', 'unique' => 0),
			'employee_id' => array('column' => 'employee_id', 'unique' => 0)
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
			'employee_id' => 1,
			'date_borrowed' => '2013-08-24 04:45:47',
			'date_returned' => '2013-08-24 04:45:47'
		),
	);

}
