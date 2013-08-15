<?php
App::uses('AppModel', 'Model');
/**
 * Ancestortype Model
 *
 */
class Ancestortype extends AppModel {

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
        ));

}
