<?php
App::uses('AppController', 'Controller');
/**
 * Applicants Controller
 *
 * @property Applicant $Applicant
 * @property PaginatorComponent $Paginator
 */
class ApplicantsController extends AppController {

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
	public function index() {
		$this->Applicant->recursive = 0;
		$this->set('applicants', $this->Paginator->paginate());
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
	public function add($id = null) {
		$this->request->data['Applicant']['clientcase_id'] = $id;
		if ($this->request->is('post')) {
			$this->Applicant->create();
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash(__('The applicant has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$clientcases = $this->Applicant->Clientcase->find('list');
		$this->set(compact('clientcases', 'archives'));
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
				$this->Session->setFlash(__('The applicant has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Applicant.' . $this->Applicant->primaryKey => $id));
			$this->request->data = $this->Applicant->find('first', $options);
		}
		$clientcases = $this->Applicant->Clientcase->find('list');
		$archives = $this->Applicant->Archive->find('list');
		$this->set(compact('clientcases', 'archives'));
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
			$this->Session->setFlash(__('Applicant deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Applicant was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
