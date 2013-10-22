<?php
App::uses('AppModel', 'Model');
/**
 * Ancestortype Model
 *
 * @property Document $Document
 */
class Ancestortype extends AppModel {

	public $validate = array(
		'ancestor_type' => array(
            'notempty' => array(
				'rule' => array(
            		'notempty'),
                	'message' => 'Please enter ancestor	type'
			),
			'validType' => array(
                'rule' => '/^[a-zA-Z\s.\-]+$/',
				'message' => 'Document type can only contains letters',
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
			'foreignKey' => 'ancestortype_id',
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
