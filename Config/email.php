<?php
class EmailConfig {

    public $default = array(
        'transport' => 'Smtp',
        'from' => array('polarontest@gmail.com' => 'Polaron'),
		'sender' => array('polarontest@gmail.com' => 'Polaron'),
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'polarontest@gmail.com',
        'password' => 'polarontest1');

}