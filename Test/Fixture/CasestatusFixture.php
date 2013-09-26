<?php
/**
 * CasestatusFixture
 *
 */
class CasestatusFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'clientcase_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'status_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'clientcase_id' => array('column' => 'clientcase_id', 'unique' => 0),
			'status_id' => array('column' => 'status_id', 'unique' => 0)
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
			'clientcase_id' => 1,
			'status_id' => 1
		),
	);

}
