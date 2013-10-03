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
 * @return void
 */

    public function notes($id = NULL) {
        $userID = $this->UserAuth->getUserId();
        $this->loadModel('Applicant');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');
        //$this->Applicant->Behaviors->load('Containable');
        //$this->Docnote->Behaviors->load('Containable');
        //$this->Applicant->Clientcase->Docnote->Behaviors->attach('Containable');

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

        $document = $this->Document->find('first', array('conditions' => array('Document.id' => $id), 'fields' => array('Document.id', 'Document.archive_id')));
        $clientcase = $this->Clientcase->find('first', array('conditions' => array ('Clientcase.archive_id' => $document['Document']['archive_id']), 'fields' => array('Clientcase.id')));

        $this->set(compact('id', 'docnotes', 'clientcase'));

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

    public function mynotes($id = NULL) {
        $userID = $this->UserAuth->getUserId();
        $this->loadModel('Applicant');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');
        //$this->Applicant->Behaviors->load('Containable');
        //$this->Docnote->Behaviors->load('Containable');
        //$this->Applicant->Clientcase->Docnote->Behaviors->attach('Containable');

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

        $document = $this->Document->find('first', array('conditions' => array('Document.id' => $id), 'fields' => array('Document.id', 'Document.archive_id')));
        $clientcase = $this->Clientcase->find('first', array('conditions' => array ('Clientcase.archive_id' => $document['Document']['archive_id']), 'fields' => array('Clientcase.id')));

        $this->set(compact('id', 'docnotes', 'clientcase'));

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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Docnote->exists($id)) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		$options = array('conditions' => array('Docnote.' . $this->Docnote->primaryKey => $id));
		$this->set('docnote', $this->Docnote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Docnote->create();
			if ($this->Docnote->save($this->request->data)) {
				$this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$documents = $this->Docnote->Document->find('list');
		$users = $this->Docnote->User->find('list');
		$this->set(compact('documents', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
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
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Docnote->id = $id;
		if (!$this->Docnote->exists()) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Docnote->delete()) {
			$this->Session->setFlash(__('Docnote deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Docnote was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
