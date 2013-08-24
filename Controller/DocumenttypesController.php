<?php
App::uses('AppController', 'Controller');
/**
 * Documenttypes Controller
 *
 * @property Documenttype $Documenttype
 * @property PaginatorComponent $Paginator
 */
class DocumenttypesController extends AppController {

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
		$this->Documenttype->recursive = 0;
		$this->set('documenttypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Documenttype->exists($id)) {
			throw new NotFoundException(__('Invalid documenttype'));
		}
		$options = array('conditions' => array('Documenttype.' . $this->Documenttype->primaryKey => $id));
		$this->set('documenttype', $this->Documenttype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Documenttype->create();
			if ($this->Documenttype->save($this->request->data)) {
				$this->Session->setFlash(__('The documenttype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The documenttype could not be saved. Please, try again.'));
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
		if (!$this->Documenttype->exists($id)) {
			throw new NotFoundException(__('Invalid documenttype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Documenttype->save($this->request->data)) {
				$this->Session->setFlash(__('The documenttype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The documenttype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Documenttype.' . $this->Documenttype->primaryKey => $id));
			$this->request->data = $this->Documenttype->find('first', $options);
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
		$this->Documenttype->id = $id;
		if (!$this->Documenttype->exists()) {
			throw new NotFoundException(__('Invalid documenttype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Documenttype->delete()) {
			$this->Session->setFlash(__('Documenttype deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Documenttype was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
