<?php
App::uses('AppController', 'Controller');
/**
 * Clientcases Controller
 *
 * @property Clientcase $Clientcase
 * @property PaginatorComponent $Paginator
 */
class ClientcasesController extends AppController {

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
    public function index($id = null) {
        $this->loadModel('Status');
        $this->Clientcase->recursive = 0;
        if(empty($id))
        {
            $clientcases =  $this->Clientcase->find('all');
        }
        else
        {
            $clientcases =  $this->Clientcase->find('all', array('conditions' => array('Clientcase.status_id' => $id)));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            return $this->redirect(array('controller' => 'clientcases', 'action' => 'index', $this->request->data['Clientcases']['status_id']));

        }

        $statuses = $this->Status->find('list');
        $this->set(compact('statuses','clientcases', 'id'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');
        $this->loadModel('DocumentType');
        $this->loadModel('AncestorType');
        $this->loadModel('User');

        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor_type'), 'order'=>'ancestor_type ASC'));



        $statuses = $this->Casestatus->Status->find('list');
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));

        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));

        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Archiveloan->save($this->request->data);
        }
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $applicantslist = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));

        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $id), 'order'=>'first_name ASC', 'recursive' => -1));
        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL));
        $this->set('ancestordocuments', $this->Document->find('all', $options), $this->Paginator->paginate());


        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL), 'order'=>'applicant_id ASC');
        $this->set('applicantdocuments', $this->Document->find('all', $options), $this->Paginator->paginate());
        $casestatuses = $this->Casestatus->find('all', array('conditions' => array('Casestatus.clientcase_id' => $clientcase['Clientcase']['id'])));

        $currentloan = $this->Archiveloan->find('first', array('conditions' => array('Archiveloan.archive_id' => $clientcase['Clientcase']['archive_id'], 'Archiveloan.date_returned' => NULL)));
        $user = $this->User->find('first', array('conditions' => array('User.id' => $clientcase['Clientcase']['user_id'])));


        $this->set(compact('clientcase', 'applicants', 'currentloan', 'employee', 'casestatuses', 'statuses', 'id', 'documentTypes', 'ancestorTypes', 'applicantslist', 'user'));
    }

    public function statustest($id = null) {
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');

        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
        $clientcases = $this->Casestatus->Clientcase->find('list');
        $statuses = $this->Casestatus->Status->find('list');
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));

        }
        /*if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Casestatus']['clientcase_id'] = $id;
            $this->request->data['Casestatus']['employee_id'] = $employee['Employee']['id'];
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }*/
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $casestatuses = $this->Casestatus->find('all', array('conditions' => array('Casestatus.clientcase_id' => $clientcase['Clientcase']['id'])));

        $this->set(compact('clientcase',  'employee', 'casestatuses', 'clientcases', 'statuses', 'id'));
    }

    public function updatestatus()
    {
        /*$this->loadModel('Casestatus');
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }
        */
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');

        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
        $clientcases = $this->Casestatus->Clientcase->find('list');
        $statuses = $this->Casestatus->Status->find('list');
        /*if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Casestatus']['clientcase_id'] = $id;
            $this->request->data['Casestatus']['employee_id'] = $employee['Employee']['id'];
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }*/
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data, false)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('clientcase',  'employee', 'casestatuses', 'clientcases', 'statuses', 'id'));
    }

    public function myaccount() {
        $id=$this->Session->read('UserAuth.User.id');
        $options = array('conditions' => array('Clientcase.user_id' => $id));
        $this->set('clientcase', $this->Clientcase->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Clientcase->create();
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The client case has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client case could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
        $users = $this->Clientcase->User->find('list');
        $archives = $this->Clientcase->Archive->find('list');
        $statuses = $this->Clientcase->Status->find('list');
        $applicants = $this->Clientcase->Applicant->find('list');
        $this->set(compact('users', 'archives', 'statuses', 'applicants'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Client Case'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The client case has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client case could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id));
            $this->request->data = $this->Clientcase->find('first', $options);
        }
        $users = $this->Clientcase->User->find('list');
        $archives = $this->Clientcase->Archive->find('list');
        $statuses = $this->Clientcase->Status->find('list');
        $applicants = $this->Clientcase->Applicant->find('list');
        $this->set(compact('users', 'archives', 'statuses', 'applicants'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Clientcase->id = $id;
        if (!$this->Clientcase->exists()) {
            throw new NotFoundException(__('Invalid client case'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Clientcase->delete()) {
            $this->Session->setFlash(__('Client case deleted', null),'default', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client case was not deleted', null),'default', array('class' => 'alert-danger'));
        return $this->redirect(array('action' => 'index'));
    }
}
