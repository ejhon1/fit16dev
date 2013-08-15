<?php
App::uses('AppController', 'Controller');
/**
 * Applicants Controller
 *
 * @property Applicant $Applicant
 */
class ApplicantsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Applicant->recursive = 0;
        $conditions = array('conditions' => array('Applicant.applicant_type' => 'Main applicant'), 'order' => 'surname ASC');
        $this->set('applicants', $this->Applicant->find('all', $conditions));
	}

    public function cases() {
        $this->Applicant->recursive = 0;
        $conditions = array('conditions' => array('Applicant.applicant_type' => 'Main applicant'), 'order' => 'surname ASC');
        $this->set('applicants', $this->Applicant->find('all', $conditions));
    }

    public function enquiries() {
        $this->Applicant->recursive = 0;
        $conditions = array('conditions' => array('Applicant.applicant_type' => 'Main applicant'), 'order' => 'surname ASC');
        $this->set('applicants', $this->Applicant->find('all', $conditions));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Applicant->exists($id)) {
			throw new NotFoundException(__('Invalid applicant'));
		}
		$options = array('conditions' => array('Applicant.' . $this->Applicant->primaryKey => $id));
		$this->set('applicant', $this->Applicant->find('first', $options));
	}

   

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Applicant->create();
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash(__('The applicant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Applicant->Client->find('list');
		$archives = $this->Applicant->Archive->find('list');
		$this->set(compact('clients', 'archives'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Applicant->exists($id)) {
			throw new NotFoundException(__('Invalid applicant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash(__('The applicant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Applicant.' . $this->Applicant->primaryKey => $id));
			$this->request->data = $this->Applicant->find('first', $options);
		}
		$clients = $this->Applicant->Client->find('list');
		$archives = $this->Applicant->Archive->find('list');
		$this->set(compact('clients', 'archives'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Applicant->id = $id;
		if (!$this->Applicant->exists()) {
			throw new NotFoundException(__('Invalid applicant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Applicant->delete()) {
			$this->Session->setFlash(__('Applicant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Applicant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
