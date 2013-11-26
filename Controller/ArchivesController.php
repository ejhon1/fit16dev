<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

/**
 * Archives Controller
 *
 * @property Archive $Archive
 * @property PaginatorComponent $Paginator
 */
class ArchivesController extends AppController {

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
        $this->loadModel('Archive');
        $this->set('archives', $this->Archive->find('all'));
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

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Archive->create();
			if ($this->Archive->save($this->request->data)) {
				$this->Session->setFlash(__('The archive has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archive could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
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
				$this->Session->setFlash(__('The archive has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The archive could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Archive.' . $this->Archive->primaryKey => $id));
			$this->request->data = $this->Archive->find('first', $options);
		}
	}
	
	public function generateArchive()
	{
		$this->loadModel('Clientcase');
		$this->loadModel('Applicant');
		$clientcase = $this->Clientcase->findByid($this->request->data['Archive']['clientcase_id']);
		$applicant = $this->Applicant->findByid($clientcase['Clientcase']['applicant_id']);
		
		$available = false;
        $i = 1;
        $name = strtoupper(substr($applicant['Applicant']['surname'], 0, 3)).'-';
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
        if($this->Archive->save($this->request->data))
		{
			$this->request->data['Clientcase']['id'] = $this->request->data['Archive']['clientcase_id'];
			$this->request->data['Clientcase']['archive_id'] = $this->Archive->getLastInsertId();
			if($this->Clientcase->save($this->request->data))
			{
				$this->Session->setFlash(__('A new archive was created for this client', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('plugin' => false, 'controller' => 'clientcases', 'action' => 'view', $clientcase['Clientcase']['id']));
			}
			else
			{
				$this->Session->setFlash(__('There was a problem with creating an archive for this client', null),'default', array('class' => 'alert-danger'));
				return $this->redirect(array('plugin' => false, 'controller' => 'clientcases', 'action' => 'view', $clientcase['Clientcase']['id']));
			}
		 }
		 else
		 {
			$this->Session->setFlash(__('There was a problem with creating an archive for this client', null),'default', array('class' => 'alert-danger'));
			return $this->redirect(array('plugin' => false, 'controller' => 'clientcases', 'action' => 'view', $clientcase['Clientcase']['id']));
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
			$this->Session->setFlash(__('Archive deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Archive was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
