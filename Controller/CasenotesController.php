<?php
App::uses('AppController', 'Controller');
/**
 * Casenotes Controller
 *
 * @property Casenote $Casenote
 * @property PaginatorComponent $Paginator
 */
class CasenotesController extends AppController {

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
		$this->Casenote->recursive = 0;
		$this->set('casenotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view() {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		$options = array('conditions' => array('Casenote.' . $this->Casenote->primaryKey => $id));
		$this->set('casenote', $this->Casenote->find('first', $options));
	}
	
	public function mynotes() {
        $userid = $this->UserAuth->getUserId();
		$this->loadModel('ClientCase');
		$this->loadModel('Casenote');

	$clientCase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $userid),'fields' => array('ClientCase.id','archive_id')));

        $options = array('conditions' => array('Casenote.clientcase_id' => $clientCase['ClientCase']['id'], 'Casenote.note_type' => 'Public'));
        $this->set('casenotes', $this->Casenote->find('all', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Casenote->create();
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The casenote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casenote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$clientcases = $this->Casenote->Clientcase->find('list');
		$users = $this->Casenote->User->find('list');
		$notesubjects = $this->Casenote->Notesubject->find('list');
		$this->set(compact('clientcases', 'users', 'notesubjects'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Casenote->exists($id)) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Casenote->save($this->request->data)) {
				$this->Session->setFlash(__('The casenote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The casenote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Casenote.' . $this->Casenote->primaryKey => $id));
			$this->request->data = $this->Casenote->find('first', $options);
		}
		$clientcases = $this->Casenote->Clientcase->find('list');
		$users = $this->Casenote->User->find('list');
		$notesubjects = $this->Casenote->Notesubject->find('list');
		$this->set(compact('clientcases', 'users', 'notesubjects'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Casenote->id = $id;
		if (!$this->Casenote->exists()) {
			throw new NotFoundException(__('Invalid casenote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Casenote->delete()) {
			$this->Session->setFlash(__('Casenote deleted'), null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Casenote was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
