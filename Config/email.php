<?php
App::uses('CakeEmail', 'Network/Email');


//class EmailConfig {
//    public function sendNewEmail() {
        // Do conditional assignments here.
//	'from' => 'polarontest@gmail.com',
//		'sender' => null,
//		'to' => 'jwgre2@student.monash.edu',
//		'cc' => null,
//		'bcc' => null,
//		'replyTo' => null,
//		'readReceipt' => null,
//		'returnPath' => 'polarontest@gmail.com',
//		'messageId' => true,
//		'subject' => 'Tester',
//		'send' => 'Just wanted to try this out.',
//		'headers' => 'What',
//		'viewRender' => null,
//		'template' => false,
//		'layout' => false,
//		'viewVars' => null,
//		'attachments' => null,
//		'emailFormat' => null,
//		'transport' => 'Smtp',
//		'host' => 'ssl://smtp.gmail.com',
//		'port' => 465,
//		'timeout' => 30,
//		'username' => 'polarontest@gmail.com',
//		'password' => 'polarontest1',
//		'client' => null,
//		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
  //  }
//}

class EmailConfig {

public $default = array(
'transport' => 'Smtp',
'from' => 'polarontest@gmail.com',
//'charset' => 'utf-8',
//'headerCharset' => 'utf-8',
);

public $smtp = array(
'transport' => 'Smtp',
'from' => array('polarontest@gmail.com' => 'My Site'),
'host' => 'ssl://smtp.gmail.com',
'port' => 465,
'timeout' => 30,
'username' => 'polarontest@gmail.com',
'password' => 'polarontest1',
'client' => null,
'log' => false,
//'charset' => 'utf-8',
//'headerCharset' => 'utf-8',
);

public $fast = array(
'from' => 'polarontest@gmail.com',
'sender' => null,
'to' => 'jwgre2@student.monash.edu',
'cc' => null,
'bcc' => null,
'replyTo' => null,
'readReceipt' => null,
'returnPath' => 'polarontest@gmail.com',
'messageId' => true,
'subject' => null,
'send' => 'Just wanted to try this out.',
'headers' => 'What',
'viewRender' => null,
'template' => false,
'layout' => false,
'viewVars' => null,
'attachments' => null,
'emailFormat' => null,
'transport' => 'Smtp',
'host' => 'ssl://smtp.gmail.com',
'port' => 465,
'timeout' => 30,
'username' => 'polarontest@gmail.com',
'password' => 'polarontest1',
'client' => null,
'log' => true,
//'charset' => 'utf-8',
//'headerCharset' => 'utf-8',
);

}


