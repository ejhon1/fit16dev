<?php
App::uses('AppController', 'Controller');
/**
 * Docnotes Controller
 *
 * @property Docnote $Docnote
 * @property PaginatorComponent $Paginator
 */
class DocnotesController extends AppController {

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
	public function index($id = NULL) {
        $userID = $this->UserAuth->getUserId();
        if(!empty($id))
        {
            $this->set('docnotes', $this->Docnote->find('all', array('conditions' => array('Docnote.document_id' => $id))));
            $this->set(compact($id));
        }
        else
        {
            $this->Docnote->recursive = 0;
            $this->set('docnotes', $this->Paginator->paginate());
        }
        if ($this->request->is('post')) {
            $this->request->data['Docnote']['document_id'] = $id;
            $this->request->data['Docnote']['user_id'] = $userID;
            $this->Docnote->create();
            if ($this->Docnote->save($this->request->data)) {
                $this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Docnote->exists($id)) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		$options = array('conditions' => array('Docnote.' . $this->Docnote->primaryKey => $id));
		$this->set('docnote', $this->Docnote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Docnote->create();
			if ($this->Docnote->save($this->request->data)) {
				$this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$documents = $this->Docnote->Document->find('list');
		$users = $this->Docnote->User->find('list');
		$this->set(compact('documents', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Docnote->exists($id)) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Docnote->save($this->request->data)) {
				$this->Session->setFlash(__('The docnote has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docnote could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Docnote.' . $this->Docnote->primaryKey => $id));
			$this->request->data = $this->Docnote->find('first', $options);
		}
		$documents = $this->Docnote->Document->find('list');
		$users = $this->Docnote->User->find('list');
		$this->set(compact('documents', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Docnote->id = $id;
		if (!$this->Docnote->exists()) {
			throw new NotFoundException(__('Invalid docnote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Docnote->delete()) {
			$this->Session->setFlash(__('Docnote deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Docnote was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
