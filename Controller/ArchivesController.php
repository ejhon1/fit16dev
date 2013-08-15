<?php
App::uses('AppController', 'Controller');
/**
 * Archives Controller
 *
 * @property Archive $Archive
 */
class ArchivesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Archive->recursive = 0;
		$this->set('archives', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Archive->exists($id)) {
			throw new NotFoundException(__('Invalid archive'));
		}
		$options = array('conditions' => array('Archive.' . $this->Archive->primaryKey => $id));
		$this->set('archive', $this->Archive->find('first', $options));
	}

    public function casedocs($id = null) {
        $this->loadModel('Client');
        $userid = $this->Auth->user('id');
        $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $userid));
        //$this->set('client', $this->Client->find('first', $options));
        $client = $this->Client->find('first', $options);
        $archiveid = $client['Client']['archive_id'];
        $options = array('conditions' => array('Archive.' . $this->Archive->primaryKey => $archiveid));
        $this->set('archive', $this->Archive->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Archive->create();
			if ($this->Archive->save($this->request->data)) {
				$this->Session->setFlash(__('The archive has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archive could not be saved. Please, try again.'));
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
		if (!$this->Archive->exists($id)) {
			throw new NotFoundException(__('Invalid archive'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Archive->save($this->request->data)) {
				$this->Session->setFlash(__('The archive has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archive could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Archive.' . $this->Archive->primaryKey => $id));
			$this->request->data = $this->Archive->find('first', $options);
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
		$this->Archive->id = $id;
		if (!$this->Archive->exists()) {
			throw new NotFoundException(__('Invalid archive'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Archive->delete()) {
			$this->Session->setFlash(__('Archive deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Archive was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
