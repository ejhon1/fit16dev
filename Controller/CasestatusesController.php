<?php
App::uses('AppController', 'Controller');
/**
 * Casestatuses Controller
 *
 * @property Casestatus $Casestatus
 * @property PaginatorComponent $Paginator
 */
class CasestatusesController extends AppController {

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
		$this->Casestatus->recursive = 0;
		$this->set('casestatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Casestatus->exists($id)) {
			throw new NotFoundException(__('Invalid Case Status'));
		}
		$options = array('conditions' => array('Casestatus.' . $this->Casestatus->primaryKey => $id));
		$this->set('casestatus', $this->Casestatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		$userid=$this->UserAuth->getUserId();
        $this->loadModel('Employee');
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
		if ($this->request->is('post')) {
            $this->request->data['Casestatus']['clientcase_id'] = $id;
            $this->request->data['Casestatus']['employee_id'] = $employee['Employee']['id'];
            $this->Casestatus->create();
			if ($this->Casestatus->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$clientcases = $this->Casestatus->Clientcase->find('list');
		$statuses = $this->Casestatus->Status->find('list');
		$this->set(compact('clientcases', 'statuses', 'employee'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Casestatus->exists($id)) {
			throw new NotFoundException(__('Invalid case status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Casestatus->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Casestatus.' . $this->Casestatus->primaryKey => $id));
			$this->request->data = $this->Casestatus->find('first', $options);
		}
		$clientcases = $this->Casestatus->Clientcase->find('list');
		$statuses = $this->Casestatus->Status->find('list');
		$this->set(compact('clientcases', 'statuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Casestatus->id = $id;
		if (!$this->Casestatus->exists()) {
			throw new NotFoundException(__('Invalid Case Status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Casestatus->delete()) {
			$this->Session->setFlash(__('Case Status deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Case Status was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}

    public function updatestatus()
    {
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');
        $this->loadModel('Clientcase');

        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
        $clientcases = $this->Casestatus->Clientcase->find('list');
        $statuses = $this->Casestatus->Status->find('list');

        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data, false)) {
                $this->request->data['Clientcase']['id'] = $this->request->data['Casestatus']['clientcase_id'];
                $this->request->data['Clientcase']['status_id'] = $this->request->data['Casestatus']['status_id'];
                $this->Clientcase->save($this->request->data, false);

                $this->Session->setFlash(__('The status has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id'], '#'=>'tab3'));
            } else {
                $this->Session->setFlash(__('The status could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id'], '#'=>'tab3'));
            }
        }

        $this->set(compact('clientcase',  'employee', 'casestatuses', 'clientcases', 'statuses', 'id'));
    }
}
