<?php
App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {


	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	public $validate = array(
		'username' => array(
			'rule' => array('maxLength', 20),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'password' => array(
			'rule' => array('maxLength', 16),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'password_confirm' => array(
			'rule' => array('maxLength', 16),
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'match'=>array(
				'rule' => 'validatePasswdConfirm',
				'message' => 'Passwords do not match'
			)
		)
	);
	
	function validatePasswdConfirm($data)
	{
		if ($this->data['User']['password'] !== $data['password_confirm'])
		{
		  return false;
		}
		return true;
	}
	
	public $hasOne = array(
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'id',
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
			'foreignKey' => 'id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
	));
}
