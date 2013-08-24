<?php
App::uses('AppController', 'Controller');
/**
 * Casenotes Controller
 *
 * @property Casenote $Casenote
 * @property PaginatorComponent $Paginator
 */
class CasenotesController extends AppController {

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
		$this->Casenote->recursive = 0;
		$this->set('casenotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		$options = array('conditions' => array('Casenote.' . $this->Casenote->primaryKey => $id));
		$this->set('casenote', $this->Casenote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Casenote->create();
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The casenote has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casenote could not be saved. Please, try again.'));
			}
		}
		$clientcases = $this->Casenote->Clientcase->find('list');
		$users = $this->Casenote->User->find('list');
		$notesubjects = $this->Casenote->Notesubject->find('list');
		$this->set(compact('clientcases', 'users', 'notesubjects'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The casenote has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casenote could not be saved. Please, try again.'));
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
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Casenote->id = $id;
		if (!$this->Casenote->exists()) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Casenote->delete()) {
			$this->Session->setFlash(__('Casenote deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Casenote was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
