<?php
App::uses('AppModel', 'Model');
/**
 * Documenttype Model
 *
 */
class Documenttype extends AppModel {


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
        ));
}
