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
				$this->Session->setFlash(__('The ancestor type has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect('../management');
			} else {
				$this->Session->setFlash(__('The ancestor type could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
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
				$this->Session->setFlash(__('The ancestor type has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect('../management');
			} else {
				$this->Session->setFlash(__('The ancestor type could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
			$options = array('conditions' => array('Ancestortype.' . $this->Ancestortype->primaryKey => $id));
			$this->request->data = $this->Ancestortype->find('first', $options);
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
			$this->Session->setFlash(__('Ancestor type deleted', null),'default', array('class' => 'alert-success'));
            return $this->redirect('../management');
		}
		$this->Session->setFlash(__('Ancestor type was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
