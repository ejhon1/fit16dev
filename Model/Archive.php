<?php
App::uses('AppModel', 'Model');
/**
 * Archife Model
 *
 */
class Archive extends AppModel {

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

    public $hasMany = array(
        'Document' => array(
            'className' => 'Document',
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
        'Clientcase' => array(
            'className' => 'Clientcase',
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
        'Archiveloan' => array(
            'className' => 'Archiveloan',
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
