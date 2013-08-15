<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 */
class ClientsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Client->recursive = 0;
		//$this->set('clients', $this->paginate());
        $conditions = array('conditions' => array('Client.status' => 'Client'));
        $this->set('clients', $this->Client->find('all', $conditions));
	}


    public function enquiries() {
        $this->Client->recursive = 0;
        $conditions = array('conditions' => array('Client.status' => 'Enquiry'));
        $this->set('clients', $this->Client->find('all', $conditions));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

        $this->loadModel('Applicant');
        //$this->loadModel('Archive');
        $this->loadModel('Ancestordocument');
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));
        $ancestordocuments = $this->Ancestordocument->find('all', array('conditions' => array('Ancestordocument.archive_id' => $client['Client']['archive_id'])));
        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.client_id' => $id), 'order'=>'first_name ASC'));
        $this->set(compact('client', 'applicants', 'ancestordocuments'));


		//$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		//$this->set('client', $this->Client->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
		$archives = $this->Client->Archive->find('list');
		$this->set(compact('archives'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
		$archives = $this->Client->Archive->find('list');
		$this->set(compact('archives'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('Client deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Client was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
