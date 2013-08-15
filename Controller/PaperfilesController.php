<?php
App::uses('AppController', 'Controller');
/**
 * Paperfiles Controller
 *
 * @property Paperfile $Paperfile
 */
class PaperfilesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $this->loadModel('Paperfilelog');
		$this->Paperfile->recursive = 0;
       // $options = array('conditions' => array('Paperfilelog.' . $this->Paperfilelog->employee_id => $id));
       // $test = $this->Paperfile->Paperfilelog->find();


        //$this->Paperfile->find('list', array('contain' => array('')));
		$this->set('paperfiles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Paperfile->exists($id)) {
			throw new NotFoundException(__('Invalid File'));
		}
		$options = array('conditions' => array('Paperfile.' . $this->Paperfile->primaryKey => $id));
		$this->set('paperfile', $this->Paperfile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Paperfile->create();
			if ($this->Paperfile->save($this->request->data)) {
				$this->Session->setFlash(__('The paperfile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfile could not be saved. Please, try again.'));
			}
		}
		$archives = $this->Paperfile->Archive->find('list');
		$this->set(compact('archives'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Paperfile->exists($id)) {
			throw new NotFoundException(__('Invalid paperfile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Paperfile->save($this->request->data)) {
				$this->Session->setFlash(__('The paperfile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paperfile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Paperfile.' . $this->Paperfile->primaryKey => $id));
			$this->request->data = $this->Paperfile->find('first', $options);
		}
		$archives = $this->Paperfile->Archive->find('list');
		$this->set(compact('archives'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Paperfile->id = $id;
		if (!$this->Paperfile->exists()) {
			throw new NotFoundException(__('Invalid paperfile'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Paperfile->delete()) {
			$this->Session->setFlash(__('Paperfile deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Paperfile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
