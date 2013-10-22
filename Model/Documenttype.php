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
		),
			'validCategory' => array(
                'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Category can only contains letters',
            )
        ),
		'type' => array(
            'notempty' => array(
				'rule' => array(
            		'notempty'),
                	'message' => 'Please enter document type'
			),
			'validType' => array(
                'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Document type can only contains letters',
            	),
			),
		'code' => array(
            'notempty' => array(
				'rule' => array(
            		'notempty'),
                	'message' => 'Please enter document code'
			),
			'validCode' => array(
                'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Document code can only contains letters',
				'allowEmpty' => false
            ),
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
