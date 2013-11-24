<?php
App::uses('AppModel', 'Model');
/**
 * Documenttype Model
 *
 * @property Document $Document
 */
class Documenttype extends AppModel {

	public $validate = array(
		'category' => array(
            'notempty' => array(
			'rule' => array(
            	'notempty'),
                'message' => 'Please enter your first name'
		)
        ),
		'type' => array(
            'notempty' => array(
				'rule' => array(
            		'notempty'),
                	'message' => 'Please enter document type'
			
			)),
		'code' => array(
            'notempty' => array(
				'rule' => array(
            		'notempty'),
                	'message' => 'Please enter document code'
			)
			
        ),
	
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Document' => array(
			'className' => 'Document',
			'foreignKey' => 'documenttype_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
