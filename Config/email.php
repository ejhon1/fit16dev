<?php
class EmailConfig {

	public $default = array(
        'transport' => 'Smtp',
        'from' => array('polarontest@gmail.com' => 'Test Mail name sender'),
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'polarontest@gmail.com',
        'password' => 'polarontest1');
        
        public $fast = array(
        'transport' => 'Smtp',
        'from' => array('polarontest@gmail.com' => 'Test Mail name sender'),
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'polarontest@gmail.com',
        'password' => 'polarontest1');

}


