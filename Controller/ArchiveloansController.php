<?php
App::uses('AppController', 'Controller');
/**
 * Archiveloans Controller
 *
 * @property Archiveloan $Archiveloan
 * @property PaginatorComponent $Paginator
 */
class ArchiveloansController extends AppController {

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
		$this->Archiveloan->recursive = 0;
		$this->set('archiveloans', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Archiveloan->exists($id)) {
			throw new NotFoundException(__('Invalid archiveloan'));
		}
		$options = array('conditions' => array('Archiveloan.' . $this->Archiveloan->primaryKey => $id));
		$this->set('archiveloan', $this->Archiveloan->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Archiveloan->create();
			if ($this->Archiveloan->save($this->request->data)) {
				$this->Session->setFlash(__('The archiveloan has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archiveloan could not be saved. Please, try again.'));
			}
		}
		$archives = $this->Archiveloan->Archive->find('list');
		$employees = $this->Archiveloan->Employee->find('list');
		$this->set(compact('archives', 'employees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Archiveloan->exists($id)) {
			throw new NotFoundException(__('Invalid archiveloan'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Archiveloan->save($this->request->data)) {
				$this->Session->setFlash(__('The archiveloan has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archiveloan could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Archiveloan.' . $this->Archiveloan->primaryKey => $id));
			$this->request->data = $this->Archiveloan->find('first', $options);
		}
		$archives = $this->Archiveloan->Archive->find('list');
		$employees = $this->Archiveloan->Employee->find('list');
		$this->set(compact('archives', 'employees'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Archiveloan->id = $id;
		if (!$this->Archiveloan->exists()) {
			throw new NotFoundException(__('Invalid archiveloan'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Archiveloan->delete()) {
			$this->Session->setFlash(__('Archiveloan deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Archiveloan was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
