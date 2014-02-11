<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Casenotes Controller
 */
class CasenotesController extends AppController {

/**
 * Case notes index page, accessed from the home page. Lists all notes on cases, most recent first.
 * Only returns notes from open cases.
 */
	public function index() {

        $this->loadModel('Casenote');

        $casenotes = $this->Casenote->query("SELECT distinct Casenote.clientcase_id, Casenote.subject, Casenote.created, Archive.archive_name, Applicant.first_name, Applicant.surname, Employee.first_name, Employee.surname
                FROM casenotes AS Casenote, clientcases AS Clientcase, archives AS Archive, applicants AS Applicant, employees AS Employee
                WHERE Casenote.clientcase_id = Clientcase.id AND Archive.id = Clientcase.archive_id AND Applicant.id = Clientcase.applicant_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            GROUP BY Casenote.id
            ORDER BY Casenote.id DESC");

        $this->set(compact('casenotes'));
    }

/**
 * Case notes view page
 *
 * Accessed by staff through case page.
 * Shows all info relating to a note.
 */
	public function view($id = NULL) {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
        $this->loadModel('Casenote');
        $this->loadModel('Employee');
        $this->loadModel('Clientcase');
        $this->loadModel('Applicant');

        $author = 'Author unknown'; //Used as a precaution. May be used by legacy notes.

        $casenote = $this->Casenote->find('first',array('conditions' => array('Casenote.' . $this->Casenote->primaryKey => $id)));
		$employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $casenote['Casenote']['user_id']), 'fields' => array('Employee.id', 'Employee.first_name', 'Employee.surname')));

        if(empty($employee['Employee']['id']))
        {
            $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $casenote['Casenote']['user_id']), 'fields' => array('Clientcase.id', 'Clientcase.applicant_id')));
            $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id']), 'fields' => array('Applicant.id', 'Applicant.first_name', 'Applicant.surname')));

            if(!empty($clientcase['Clientcase']['id']))
            {
                $author = $applicant['Applicant']['first_name'].' '.$applicant['Applicant']['surname'];
            }
        }
        else
        {
            $author = $employee['Employee']['first_name'].' '.$employee['Employee']['surname'];
        }

        $this->set(compact('casenote', 'author'));
	}

/**
 * Case notes mynotes page
 *
 * Used by clients to view notes relating to their case.
 */
	public function mynotes() {
        $userid = $this->UserAuth->getUserId();
		$this->loadModel('Clientcase');
		$this->loadModel('Casenote');
        $this->loadModel('Applicant');

		$clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $userid),'fields' => array('Clientcase.id','archive_id')));
        $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id'])));

        $casenotes = $this->Casenote->query("SELECT distinct Casenote.subject, Casenote.note_type, Casenote.created, Casenote.note, Employee.first_name, Employee.surname
        FROM clientcases AS Clientcase, casenotes AS Casenote LEFT JOIN employees AS Employee ON Employee.user_id = Casenote.user_id
        WHERE Casenote.clientcase_id = Clientcase.id AND Clientcase.id = ".$clientcase['Clientcase']['id']." AND Casenote.note_type = 'Public'
        GROUP BY Casenote.id
        Order by Casenote.id DESC");
		$this->set(compact('casenotes', 'applicant'));
	}

/**
 * Add page for case notes.
 * Used by staff to add notes to a case.
 */
	public function add($id=null) {
		$userId=$this->Session->read('UserAuth.User.id');
		if ($this->request->is('post')) {
			$this->request->data['Casenote']['clientcase_id'] = $id;
			$this->request->data['Casenote']['user_id'] = $userId;
			$this->Casenote->create();
			if ($this->Casenote->save($this->request->data)) {
				if ($this->request->data['Casenote']['note_type'] == 'Public'){
                    $this->email($id);
                }
				$this->Session->setFlash(__('The contact note was saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'Clientcases', 'action' => 'view', $id, '#' => 'tab4'));
			} else {
				$this->Session->setFlash(__('The contact note could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'Clientcases', 'action' => 'view', $id, '#' => 'tab4'));
            }
		}
		$clientcases = $this->Casenote->Clientcase->find('list');

		$this->set(compact('clientcases', 'users', 'notesubjects'));
	}

    /**
     * mynotesadd function for case notes.
     * Accessed by the modal on the mynotes page in the client view.
     * Used by the client to add notes to their case.
     */
	
	public function mynotesadd() {
		$userId=$this->Session->read('UserAuth.User.id');

		if ($this->request->is('post')) {
			$this->Casenote->create();
			$this->loadModel('Clientcase');

			$clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $userId)));
            $this->request->data['Casenote']['user_id'] = $userId;
            $this->request->data['Casenote']['clientcase_id'] = $clientcase['Clientcase']['id'];
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The contact note was saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'Casenotes', 'action' => 'mynotes'));
			} else {
				$this->Session->setFlash(__('The contact note could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'Casenotes', 'action' => 'mynotes'));
			}
		}
	}

/**
 * edit page for case notes.
 * Accessed through the case page and used only by certain staff members.
 */
	public function edit($id = null) {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The contact note was saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact note could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Casenote.' . $this->Casenote->primaryKey => $id));
			$this->request->data = $this->Casenote->find('first', $options);
		}
		$clientcases = $this->Casenote->Clientcase->find('list');
		$users = $this->Casenote->User->find('list');
		$notesubjects = $this->Casenote->Notesubject->find('list');
		$this->set(compact('clientcases', 'users', 'notesubjects'));
	}

/**
 * email function for case notes.
 * Used by the add function to send an email to the client when a public note is added to their case.
 */
    public function email($id){
        $this->loadModel('Applicant');
        $this->loadModel('Clientcase');

        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.id' => $id)));
        $applicants = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id']), 'fields' => array('Applicant.email', 'Applicant.first_name')));

        $Email = new CakeEmail();
        $Email->config('default');
        $Email->to($applicants['Applicant']['email']);
        $Email->subject('New Case Note Added To Your Case!');
        $Email->template('casenotes');
        $Email->emailFormat('text');
        $Email->viewVars(array('name' => $applicants['Applicant']['first_name']));

        $Email->send();
    }

/**
 * report function for case notes.
 * Used by the generate reports page (clientcases/reporting) to create an excel report.
 */
    public function report()
    {
        $this->loadModel('Casenote');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Casenote']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Casenote']['date2'])));

        $data = $this->Casenote->query("SELECT distinct Casenote.clientcase_id, Casenote.subject, Casenote.created, Archive.archive_name, Applicant.first_name, Applicant.surname, Employee.first_name, Employee.surname
                FROM casenotes AS Casenote, clientcases AS Clientcase, archives AS Archive, applicants AS Applicant, employees AS Employee
                WHERE Casenote.clientcase_id = Clientcase.id AND Archive.id = Clientcase.archive_id AND Applicant.id = Clientcase.applicant_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Casenote.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Casenote.created, '%Y%m%d') <= ".$date2."
                AND (Casenote.user_id = Employee.user_id OR Casenote.user_id = Clientcase.user_id)
                group by Casenote.id");
        $this->set(compact('data'));
    }
}