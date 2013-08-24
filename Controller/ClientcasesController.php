<?php
App::uses('AppController', 'Controller');
/**
 * Clientcases Controller
 *
 * @property Clientcase $Clientcase
 * @property PaginatorComponent $Paginator
 */
class ClientcasesController extends AppController {

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
		$this->Clientcase->recursive = 0;
		$this->set('clientcases', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Clientcase->exists($id)) {
			throw new NotFoundException(__('Invalid clientcase'));
		}
		$options = array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id));
		$this->set('clientcase', $this->Clientcase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Clientcase->create();
			if ($this->Clientcase->save($this->request->data)) {
				$this->Session->setFlash(__('The clientcase has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clientcase could not be saved. Please, try again.'));
			}
		}
		$users = $this->Clientcase->User->find('list');
		$archives = $this->Clientcase->Archive->find('list');
		$statuses = $this->Clientcase->Status->find('list');
		$applicants = $this->Clientcase->Applicant->find('list');
		$this->set(compact('users', 'archives', 'statuses', 'applicants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Clientcase->exists($id)) {
			throw new NotFoundException(__('Invalid clientcase'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Clientcase->save($this->request->data)) {
				$this->Session->setFlash(__('The clientcase has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The clientcase could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id));
			$this->request->data = $this->Clientcase->find('first', $options);
		}
		$users = $this->Clientcase->User->find('list');
		$archives = $this->Clientcase->Archive->find('list');
		$statuses = $this->Clientcase->Status->find('list');
		$applicants = $this->Clientcase->Applicant->find('list');
		$this->set(compact('users', 'archives', 'statuses', 'applicants'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Clientcase->id = $id;
		if (!$this->Clientcase->exists()) {
			throw new NotFoundException(__('Invalid clientcase'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Clientcase->delete()) {
			$this->Session->setFlash(__('Clientcase deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Clientcase was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
