<?php
App::uses('AppController', 'Controller');
/**
 * Paperfilelogs Controller
 *
 * @property Paperfilelog $Paperfilelog
 * @property PaginatorComponent $Paginator
 */
class PaperfilelogsController extends AppController {

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
		$this->Paperfilelog->recursive = 0;
		$this->set('paperfilelogs', $this->Paginator->paginate());
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
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfilelog could not be saved. Please, try again.'));
			}
		}
		$archives = $this->Paperfilelog->Archive->find('list');
		$employees = $this->Paperfilelog->Employee->find('list');
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
		if (!$this->Paperfilelog->exists($id)) {
			throw new NotFoundException(__('Invalid paperfilelog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Paperfilelog->save($this->request->data)) {
				$this->Session->setFlash(__('The paperfilelog has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfilelog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Paperfilelog.' . $this->Paperfilelog->primaryKey => $id));
			$this->request->data = $this->Paperfilelog->find('first', $options);
		}
		$archives = $this->Paperfilelog->Archive->find('list');
		$employees = $this->Paperfilelog->Employee->find('list');
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
		$this->Paperfilelog->id = $id;
		if (!$this->Paperfilelog->exists()) {
			throw new NotFoundException(__('Invalid paperfilelog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Paperfilelog->delete()) {
			$this->Session->setFlash(__('Paperfilelog deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Paperfilelog was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
