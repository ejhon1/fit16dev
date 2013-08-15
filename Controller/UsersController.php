<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('newclient','newemployee'); // Letting users register themselves
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function newclient() {
        //$this->User->recursive = 2;
        $this->loadModel('Enquiry');
        $this->loadModel('Archive');
        $this->loadModel('Applicant');
        $this->loadModel('Client');
		if ($this->request->is('post')) {
			$this->createArchive(); //Leads to the function that creates the Archive entry.
            $this->request->data['Enquiry']['nationality_of_parents']= implode(',', $this->request->data['Enquiry']['nationality_of_parents']);
            $this->request->data['Enquiry']['nationality_of_grandparents']= implode(',', $this->request->data['Enquiry']['nationality_of_grandparents']);
            $this->request->data['Enquiry']['when_left_poland']= implode(',', $this->request->data['Enquiry']['when_left_poland']);

            $this->request->data['Enquiry']['where_left_poland']= implode(',', $this->request->data['Enquiry']['where_left_poland']);
            $this->request->data['Enquiry']['possess_documents_types']= implode(',', $this->request->data['Enquiry']['possess_documents_types']);
            $this->request->data['Enquiry']['other_factors']= implode(',', $this->request->data['Enquiry']['other_factors']);
            //var_dump($this->data);
			$this->User->create();
			if ($this->User->saveAll($this->request->data, array('deep' => true))) {
				$this->request->data['Applicant']['client_id'] =  $this->Client->getLastInsertId();
                $this->request->data['Enquiry']['client_id'] =  $this->Client->getLastInsertId();
				$this->Applicant->create();
				$this->Applicant->save($this->request->data);
                $this->Enquiry->create();
                $this->Enquiry->save($this->request->data);

				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'display'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please try again.'));
			}
		}
	}
	
	public function newemployee() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list', array('order'=>'type ASC'));
		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function createArchive()
	{
		$available = false;
		$i = 1;
		$name = strtoupper(substr("abcdef", 0, 3)).'-';
		$year = substr(idate('Y', $timestamp = time()), -2);
		do
		{
			$archiveName = $name.$i.'/'.$year;
			$conditions = array('Archive.archive_name' => $archiveName);

			if($this->Archive->hasAny($conditions))
			{
				$i++;
			}
			else
			{
				$available = true;
			}			
		}while(!$available);
		
		$this->request->data['Archive']['archive_name'] = $archiveName;
		$this->Archive->create();
		$this->Archive->save($this->request->data);
		
		$this->request->data['Client']['archive_id'] =  $this->Archive->getLastInsertId();
        $this->request->data['Applicant']['archive_id'] =  $this->Archive->getLastInsertId();
	}

}
