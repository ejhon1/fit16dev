<?php
/**
 * CasenoteFixture
 *
 */
class CasenoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'clientcase_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'index'),
		'notesubject_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
		'note_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 46, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'note' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'clientcase_id' => array('column' => 'clientcase_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0)
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
			'user_id' => 1,
			'notesubject_id' => 1,
			'note_type' => 'Lorem ipsum dolor sit amet',
			'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-08-24 04:39:24',
			'modified' => '2013-08-24 04:39:24'
		),
	);

}
