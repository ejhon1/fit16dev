<?php
App::uses('AppController', 'Controller');
/**
 * Ancestortypes Controller
 *
 * @property Ancestortype $Ancestortype
 * @property PaginatorComponent $Paginator
 */
class AncestortypesController extends AppController {

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
		$this->Ancestortype->recursive = 0;
		$this->set('ancestortypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ancestortype->exists($id)) {
			throw new NotFoundException(__('Invalid ancestortype'));
		}
		$options = array('conditions' => array('Ancestortype.' . $this->Ancestortype->primaryKey => $id));
		$this->set('ancestortype', $this->Ancestortype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ancestortype->create();
			if ($this->Ancestortype->save($this->request->data)) {
				$this->Session->setFlash(__('The ancestortype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ancestortype could not be saved. Please, try again.'));
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
		if (!$this->Ancestortype->exists($id)) {
			throw new NotFoundException(__('Invalid ancestortype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ancestortype->save($this->request->data)) {
				$this->Session->setFlash(__('The ancestortype has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ancestortype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ancestortype.' . $this->Ancestortype->primaryKey => $id));
			$this->request->data = $this->Ancestortype->find('first', $options);
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
		$this->Ancestortype->id = $id;
		if (!$this->Ancestortype->exists()) {
			throw new NotFoundException(__('Invalid ancestortype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ancestortype->delete()) {
			$this->Session->setFlash(__('Ancestortype deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ancestortype was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
