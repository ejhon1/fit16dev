<?php
/**
 * ApplicantFixture
 *
 */
class ApplicantFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'primary'),
		'clientcase_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'archive_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 12, 'key' => 'index'),
		'birthdate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 12, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'first_name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'middle_name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'surname' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'landline_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mobile_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'applicant_type' => array('type' => 'string', 'null' => true, 'default' => 'Main applicant', 'length' => 26, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'clientcase_id' => array('column' => 'clientcase_id', 'unique' => 0),
			'archive_id' => array('column' => 'archive_id', 'unique' => 0)
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
			'archive_id' => 1,
			'birthdate' => '2013-08-24 04:39:01',
			'title' => 'Lorem ipsu',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'middle_name' => 'Lorem ipsum dolor sit amet',
			'surname' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'landline_number' => 'Lorem ipsum dolor sit amet',
			'mobile_number' => 'Lorem ipsum dolor sit amet',
			'applicant_type' => 'Lorem ipsum dolor sit am',
			'created' => '2013-08-24 04:39:01',
			'modified' => '2013-08-24 04:39:01'
		),
	);

}
