<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Casenote $Casenote
 * @property Clientcase $Clientcase
 * @property Docnote $Docnote
 * @property Employee $Employee
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
		'required'=>'notEmpty',
		'match'=>array(
		'rule' => 'validatePasswdConfirm',
		'message' => 'Passwords do not match'

            )
        )
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */

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
            'foreignKey' => 'user_id',
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
        'Clientcase' => array(
            'className' => 'Clientcase',
            'foreignKey' => 'user_id',
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


	public $hasMany = array(
		'Casenote' => array(
			'className' => 'Casenote',
			'foreignKey' => 'user_id',
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
		'Docnote' => array(
			'className' => 'Docnote',
			'foreignKey' => 'user_id',
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
