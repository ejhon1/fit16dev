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
            $count[$i] = $this->Clientcase->find('count', array('conditions' => array('Clientcase.status_id' => $status['Status']['id'])));
            $i++;
        endforeach;

        //Recent documents list
        $this->loadModel('Document');
        //$documents = $this->Document->find('all', array('order' => array('Document.created' => 'DESC'), 'limit' => 10));

        $documents = $this->Document->query("SELECT distinct Document.id, Document.copy_type, Document.applicant_id, Document.ancestortype_id,Document.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM documents AS Document, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
            WHERE Document.archive_id = Archive.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            ORDER BY Document.id DESC
            LIMIT 5;");


        //Recent contact notes list
        $this->loadModel('Casenote');
        //$casenotes = $this->Casenote->find('all', array('order' => array('Casenote.created' => 'DESC'), 'limit' => 5));

        $casenotes = $this->Casenote->query("SELECT distinct Casenote.clientcase_id, Casenote.subject, Casenote.note, Casenote.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM casenotes AS Casenote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
            WHERE Casenote.clientcase_id = Clientcase.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            ORDER BY Casenote.id DESC
            LIMIT 5;");


        //Recent docnotes list
        $this->loadModel('Docnote');
        $this->loadModel('Applicant');

        $docnotes = $this->Docnote->query("SELECT distinct Docnote.id,  Docnote.note, Docnote.document_id, Docnote.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM docnotes AS Docnote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
            WHERE Docnote.clientcase_id = Clientcase.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            ORDER BY Docnote.id DESC
            LIMIT 5;");

        $this->set(compact('statuses', 'count', 'documents', 'casenotes', 'docnotes'));


    }

}
