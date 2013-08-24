<?php
App::uses('AppModel', 'Model');
/**
 * Archife Model
 *
 */
class Archife extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'file_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
