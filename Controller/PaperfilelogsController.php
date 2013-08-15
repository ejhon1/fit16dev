<?php
App::uses('AppController', 'Controller');
/**
 * Paperfilelogs Controller
 *
 * @property Paperfilelog $Paperfilelog
 */
class PaperfilelogsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paperfilelog->recursive = 0;
		$this->set('paperfilelogs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Paperfilelog->exists($id)) {
			throw new NotFoundException(__('Invalid paperfilelog'));
		}
		$options = array('conditions' => array('Paperfilelog.' . $this->Paperfilelog->primaryKey => $id));
		$this->set('paperfilelog', $this->Paperfilelog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Paperfilelog->create();
			if ($this->Paperfilelog->save($this->request->data)) {
				$this->Session->setFlash(__('The paperfilelog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfilelog could not be saved. Please, try again.'));
			}
		}
		$paperfiles = $this->Paperfilelog->Paperfile->find('list');
		$employees = $this->Paperfilelog->Employee->find('list');
		$this->set(compact('paperfiles', 'employees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Paperfilelog->exists($id)) {
			throw new NotFoundException(__('Invalid paperfilelog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Paperfilelog->save($this->request->data)) {
				$this->Session->setFlash(__('The paperfilelog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfilelog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Paperfilelog.' . $this->Paperfilelog->primaryKey => $id));
			$this->request->data = $this->Paperfilelog->find('first', $options);
		}
		$paperfiles = $this->Paperfilelog->Paperfile->find('list');
		$employees = $this->Paperfilelog->Employee->find('list');
		$this->set(compact('paperfiles', 'employees'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Paperfilelog->id = $id;
		if (!$this->Paperfilelog->exists()) {
			throw new NotFoundException(__('Invalid paperfilelog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Paperfilelog->delete()) {
			$this->Session->setFlash(__('Paperfilelog deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Paperfilelog was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
