<?php
App::uses('AppModel', 'Model');
/**
 * Archive Model
 *
 * @property Ancestordocument $Ancestordocument
 * @property Applicantdocument $Applicantdocument
 * @property Applicant $Applicant
 * @property Client $Client
 * @property Paperfile $Paperfile
 */
class Archive extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ancestordocument' => array(
			'className' => 'Ancestordocument',
			'foreignKey' => 'archive_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Applicantdocument' => array(
			'className' => 'Applicantdocument',
			'foreignKey' => 'archive_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Applicant' => array(
			'className' => 'Applicant',
			'foreignKey' => 'archive_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'archive_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Paperfile' => array(
			'className' => 'Paperfile',
			'foreignKey' => 'archive_id',
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
