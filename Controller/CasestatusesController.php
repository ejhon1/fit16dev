<?php
App::uses('AppController', 'Controller');
/**
 * Casestatuses Controller
 *
 * @property Casestatus $Casestatus
 * @property PaginatorComponent $Paginator
 */
class CasestatusesController extends AppController {

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
		$this->Casestatus->recursive = 0;
		$this->set('casestatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Casestatus->exists($id)) {
			throw new NotFoundException(__('Invalid casestatus'));
		}
		$options = array('conditions' => array('Casestatus.' . $this->Casestatus->primaryKey => $id));
		$this->set('casestatus', $this->Casestatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Casestatus->create();
			if ($this->Casestatus->save($this->request->data)) {
				$this->Session->setFlash(__('The casestatus has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casestatus could not be saved. Please, try again.'));
			}
		}
		$clientcases = $this->Casestatus->Clientcase->find('list');
		$statuses = $this->Casestatus->Status->find('list');
		$this->set(compact('clientcases', 'statuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Casestatus->exists($id)) {
			throw new NotFoundException(__('Invalid casestatus'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Casestatus->save($this->request->data)) {
				$this->Session->setFlash(__('The casestatus has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casestatus could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Casestatus.' . $this->Casestatus->primaryKey => $id));
			$this->request->data = $this->Casestatus->find('first', $options);
		}
		$clientcases = $this->Casestatus->Clientcase->find('list');
		$statuses = $this->Casestatus->Status->find('list');
		$this->set(compact('clientcases', 'statuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Casestatus->id = $id;
		if (!$this->Casestatus->exists()) {
			throw new NotFoundException(__('Invalid casestatus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Casestatus->delete()) {
			$this->Session->setFlash(__('Casestatus deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Casestatus was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
