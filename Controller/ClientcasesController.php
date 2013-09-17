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
    public function index() {
        $this->loadModel('Status');
        $this->Clientcase->recursive = 0;
        $this->set('clientcases', $this->Clientcase->find('all'));
        if ($this->request->is('post') || $this->request->is('put')) {
            $status = $this->request->data['Clientcases']['status_id'];
            $this->set(compact('status'));
        }

        $statuses = $this->Status->find('list');
        $this->set(compact('statuses'));
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
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));

        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Archiveloan->save($this->request->data);
        }
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $id), 'order'=>'first_name ASC', 'recursive' => -1));
        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL));
        $this->set('ancestordocuments', $this->Document->find('all', $options), $this->Paginator->paginate());

        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL), 'order'=>'applicant_id ASC');
        $this->set('applicantdocuments', $this->Document->find('all', $options), $this->Paginator->paginate());

        $currentloan = $this->Archiveloan->find('first', array('conditions' => array('Archiveloan.archive_id' => $clientcase['Clientcase']['archive_id'], 'Archiveloan.date_returned' => NULL)));
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));


        $this->set(compact('clientcase', 'applicants', 'currentloan', 'employee'));
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
                $this->Session->setFlash(__('The clientcase has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The clientcase could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
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
            throw new NotFoundException(__('Invalid clientcase'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The clientcase has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The clientcase could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
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
            throw new NotFoundException(__('Invalid clientcase'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Clientcase->delete()) {
            $this->Session->setFlash(__('Clientcase deleted', null),'default', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Clientcase was not deleted', null),'default', array('class' => 'alert-danger'));
        return $this->redirect(array('action' => 'index'));
    }
}
