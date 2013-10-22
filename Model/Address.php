<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 * @property Applicant $Applicant
 * @property Country $Country
 */
class Address extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'applicant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address_line' => array(
            		'validAddress' => array(
                		'rule' => '/^[a-zA-Z0-9\s.\-]+$/',
				'message' => 'Invalid address. Please try again!',
				'allowEmpty' => false
            		),
			'between' => array(
				'rule' => array('between', 5, 50),
				'message' => 'Invalid. Please try again!'
			)
        	),
		'suburb' => array(
            		'validSuburb' => array(
                		'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Suburb can only contains letters',
				'allowEmpty' => false
            		),
			'between' => array(
				'rule' => array('between', 2, 50),
				'message' => 'Invalid. Please try again!'
			)
        	),
		'postcode' => array(
            		'numeric' => array(
                		'rule' => array('numeric'),
				'message' => 'Invalid postcode. Please try again!',
				'allowEmpty' => false
            		),
			'between' => array(
				'rule' => array('between', 4, 10),
				'message' => 'Invalid postcode. Please try again!'
			)
        	),
		'state' => array(
            		'validState' => array(
                		'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'State can only contains letters',
				'allowEmpty' => false
            		),
			'between' => array(
				'rule' => array('between', 2, 50),
				'message' => 'Invalid. Please try again!'
			)
        	),
		'status' => array(
            		'validStatus' => array(
                	'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Status can only contains letters',
				'allowEmpty' => false
            		),
			'between' => array(
				'rule' => array('between', 1, 50),
				'message' => 'Invalid. Please try again!'
			)
        	),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Applicant' => array(
			'className' => 'Applicant',
			'foreignKey' => 'applicant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
