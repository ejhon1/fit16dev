<?php
App::uses('AppController', 'Controller');
/**
 * Notesubjects Controller
 *
 * @property Notesubject $Notesubject
 * @property PaginatorComponent $Paginator
 */
class NotesubjectsController extends AppController {

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
		$this->Notesubject->recursive = 0;
		$this->set('notesubjects', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notesubject->exists($id)) {
			throw new NotFoundException(__('Invalid notesubject'));
		}
		$options = array('conditions' => array('Notesubject.' . $this->Notesubject->primaryKey => $id));
		$this->set('notesubject', $this->Notesubject->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notesubject->create();
			if ($this->Notesubject->save($this->request->data)) {
				$this->Session->setFlash(__('The notesubject has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notesubject could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Notesubject->exists($id)) {
			throw new NotFoundException(__('Invalid notesubject'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Notesubject->save($this->request->data)) {
				$this->Session->setFlash(__('The notesubject has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notesubject could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notesubject.' . $this->Notesubject->primaryKey => $id));
			$this->request->data = $this->Notesubject->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Notesubject->id = $id;
		if (!$this->Notesubject->exists()) {
			throw new NotFoundException(__('Invalid notesubject'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notesubject->delete()) {
			$this->Session->setFlash(__('Notesubject deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Notesubject was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
