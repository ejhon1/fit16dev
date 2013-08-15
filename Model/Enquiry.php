<?php
App::uses('AppModel', 'Model');
/**
 * Enquiry Model
 *
 * @property Client $Client
 */
class Enquiry extends AppModel {



/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'mother_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'father_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'mat_grandmother_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'mat_grandfather_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'pat_grandmother_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'pat_grandfather_name' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 30),
        ),
        'nationality_of_others' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 600),
        ),
        'serve_in_army_info' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 600),
        ),
        'where_left_poland_other' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 600),
        ),
        'possess_documents_other' => array(
            'allowEmpty' => true,
            'last' => false,
            'rule' => array('maxLength', 600),
        ));

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
