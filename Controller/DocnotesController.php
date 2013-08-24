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
	public function index() {
		$this->Docnote->recursive = 0;
		$this->set('docnotes', $this->Paginator->paginate());
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
				$this->Session->setFlash(__('The docnote has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.'));
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
				$this->Session->setFlash(__('The docnote has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.'));
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
			$this->Session->setFlash(__('Docnote deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Docnote was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
