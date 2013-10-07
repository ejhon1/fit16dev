<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
        $this->home();

		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
    public function home()
    {
        $this->loadModel('Clientcase');

        //Status list
        $this->loadModel('Status');
        $statuses =  $this->Status->find('all');
        $i=0;
        foreach($statuses as $status):
            //$status['Status']['count'] = $this->Clientcase->find('count', array('conditions' => array('Clientcase.status_id' => $status['Status']['id'])));
            $count[$i] = $this->Clientcase->find('count', array('conditions' => array('Clientcase.status_id' => $status['Status']['id'])));
            $i++;
        endforeach;

        //Recent documents list
        $this->loadModel('Document');
        $documents = $this->Document->find('all', array('order' => array('Document.created' => 'DESC'), 'limit' => 10));

        //Recent contact notes list
        $this->loadModel('Casenote');
        $casenotes = $this->Casenote->find('all', array('order' => array('Casenote.created' => 'DESC'), 'limit' => 5));

        //Recent docnotes list
        $this->loadModel('Docnote');
        $this->loadModel('Applicant');

        $docnotes = $this->Applicant->Clientcase->Docnote->find('all', array(
            'contain' => array(
                'Clientcase' => array('fields' => array ('id' ),
                    'Applicant' => array(
                        'fields' => array ( 'Applicant.id', 'Applicant.first_name', 'Applicant.surname' )
                    )
                ),
                'Employee' => array('fields' => array('Employee.first_name', 'Employee.surname'))
            ),
            'order' => array('Docnote.created' => 'DESC'), 'limit' => 5
        ));

        //$docnotes = $this->Docnote->find('all', array('order' => array('Docnote.created' => 'DESC'), 'limit' => 5));

        $this->set(compact('statuses', 'count', 'documents', 'casenotes', 'docnotes'));


    }

}
