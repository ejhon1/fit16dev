<?php
App::uses('AppController', 'Controller');
/**
 * Docnotes Controller
 *
 * @property Docnote $Docnote
 * @property PaginatorComponent $Paginator
 */
class DocnotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * A list of docnotes ordered by most recent
 */
    public function index() {
        $this->loadModel('Docnote');
        $this->loadModel('Applicant');

        $docnotes = $this->Docnote->query("SELECT distinct Docnote.id,  Docnote.note, Docnote.document_id, Docnote.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM docnotes AS Docnote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
            WHERE Docnote.clientcase_id = Clientcase.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            ORDER BY Docnote.id DESC;");

        $this->set(compact('docnotes'));

    }
    /**
     * notes method
     *
     * Staff view for document notes
     */
    public function notes($id = NULL) {
        $userID = $this->UserAuth->getUserId();
        $this->loadModel('Applicant');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');

        $docnotes = $this->Applicant->Clientcase->Docnote->find('all', array(
            'contain' => array(
                'Clientcase' => array('fields' => array ('id' ),
                    'Applicant' => array(
                            'fields' => array ( 'Applicant.id', 'Applicant.first_name', 'Applicant.surname' )
                    )
                ),
                'Employee' => array('fields' => array('Employee.first_name', 'Employee.surname'))
            ),
            'conditions' => array(
                'Docnote.document_id' => $id
            )
        ));

        $document = $this->Document->find('first', array('conditions' => array('Document.id' => $id)));
        $clientcase = $this->Clientcase->find('first', array('conditions' => array ('Clientcase.archive_id' => $document['Document']['archive_id']), 'fields' => array('Clientcase.id')));

        $this->set(compact('id', 'docnotes', 'clientcase', 'document'));

        if ($this->request->is('post')) {
            $this->loadModel('Employee');
            $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userID)));
            $this->request->data['Docnote']['document_id'] = $id;
            $this->request->data['Docnote']['employee_id'] = $employee['Employee']['id'];
            $this->Docnote->create();
            if ($this->Docnote->save($this->request->data)) {
                $this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'notes', $id));
            } else {
                $this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
    }

    /**
     * mynotes method
     *
     * Page viewed by the client containing doc notes for a document
     */

    public function mynotes($id = NULL) {
        $userID = $this->UserAuth->getUserId();
        $this->loadModel('Applicant');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');

        $document = $this->Document->find('first', array('conditions' => array('Document.id' => $id)));

        $docnotes = $this->Applicant->Clientcase->Docnote->find('all', array(
            'contain' => array(
                'Clientcase' => array('fields' => array ('id' ),
                    'Applicant' => array(
                        'fields' => array ( 'Applicant.id', 'Applicant.first_name', 'Applicant.surname' )
                    )
                ),
                'Employee' => array('fields' => array('Employee.first_name', 'Employee.surname'))
            ),
            'conditions' => array(
                'Docnote.document_id' => $id
            )
        ));

        $clientcase = $this->Clientcase->find('first', array('conditions' => array ('Clientcase.archive_id' => $document['Document']['archive_id']), 'fields' => array('Clientcase.id')));

        $this->set(compact('id', 'docnotes', 'clientcase', 'document'));

        if ($this->request->is('post')) {
            $client = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $userID)));
            $this->request->data['Docnote']['document_id'] = $id;
            $this->request->data['Docnote']['clientcase_id'] = $client['Clientcase']['id'];
            $this->Docnote->create();
            if ($this->Docnote->save($this->request->data)) {
                $this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'mynotes', $id));
            } else {
                $this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
    }



/**
 * edit method
 *
 */
	public function edit($id = null) {
		if (!$this->Docnote->exists($id)) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Docnote->save($this->request->data)) {
				$this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Docnote.' . $this->Docnote->primaryKey => $id));
			$this->request->data = $this->Docnote->find('first', $options);
		}
		$documents = $this->Docnote->Document->find('list');
		$users = $this->Docnote->User->find('list');
		$this->set(compact('documents', 'users'));
	}

    /**
     * report method
     *
     * Used to generate an excel report
     */
	
	public function report()
    {
        $this->loadModel('Docnote');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Docnote']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Docnote']['date2'])));

        $data = $docnotes = $this->Docnote->query("SELECT distinct Docnote.id,  Docnote.note, Docnote.document_id, Docnote.employee_id, Docnote.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name, Employee.first_name, Employee.surname
                FROM docnotes AS Docnote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, employees AS Employee
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Docnote.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Docnote.created, '%Y%m%d') <= ".$date2."
                AND (Docnote.employee_id = Employee.id OR Docnote.clientcase_id = Clientcase.id)
				group by Docnote.id;");
        $this->set(compact('data'));
    }
}
