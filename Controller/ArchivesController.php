<?php
App::uses('AppController', 'Controller');
/**
 * Archives Controller
 *
 * @property Archife $Archife
 * @property PaginatorComponent $Paginator
 */
class ArchivesController extends AppController {

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
		$this->Archife->recursive = 0;
		$this->set('archives', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Archife->exists($id)) {
			throw new NotFoundException(__('Invalid archife'));
		}
		$options = array('conditions' => array('Archife.' . $this->Archife->primaryKey => $id));
		$this->set('archife', $this->Archife->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Archife->create();
			if ($this->Archife->save($this->request->data)) {
				$this->Session->setFlash(__('The archife has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archife could not be saved. Please, try again.'));
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
		if (!$this->Archife->exists($id)) {
			throw new NotFoundException(__('Invalid archife'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Archife->save($this->request->data)) {
				$this->Session->setFlash(__('The archife has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archife could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Archife.' . $this->Archife->primaryKey => $id));
			$this->request->data = $this->Archife->find('first', $options);
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
		$this->Archife->id = $id;
		if (!$this->Archife->exists()) {
			throw new NotFoundException(__('Invalid archife'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Archife->delete()) {
			$this->Session->setFlash(__('Archife deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Archife was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
