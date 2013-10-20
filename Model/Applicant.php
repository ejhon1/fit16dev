<?php
App::uses('AppModel', 'Model');
/**
 * Applicant Model
 *
 * @property Clientcase $Clientcase
 * @property Archive $Archive
 * @property Address $Address
 * @property Document $Document
 */
class Applicant extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'clientcase_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
//'message' => 'Your custom message here',
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'first_name' => array(
            'notempty' => array(
                'rule' => array(
                    'notempty'),
                'message' => 'Please enter your first name'
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'lettersOnly' => array(
                'rule' => '/^[a-zA-Z]+$/',
                'message' => 'Name can only contain letters'
            )
        ),
        'surname' => array(
            'notempty' => array(
                'rule' => array(
                    'notempty'),
                'message' => 'Please enter your surname'
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'lettersOnly' => array(
                'rule' => '/^[a-zA-Z]+$/',
                'message' => 'Name can only contain letters'
            )
        ),
        /*'email' => array(

            'validEmail' => array(
                'rule' => array(
                    'email'
                ),
                'allowEmpty' => true,
                'message' => 'Invalid email address! Please try again!'
            ),
            'uniqueEmail' => array(
                'rule' => array(
                    'isUnique'
                ),
                'allowEmpty' => true,
                'message' => 'This email is already registered'
            )
        )*/
    );

//The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Clientcase' => array(
            'className' => 'Clientcase',
            'foreignKey' => 'clientcase_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Address' => array(
            'className' => 'Address',
            'foreignKey' => 'applicant_id',
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
            'foreignKey' => 'applicant_id',
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
        'Document' => array(
            'className' => 'Document',
            'foreignKey' => 'applicant_id',
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
