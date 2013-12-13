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

	public $components = array('Paginator');

/**
 * view method
 *
 * Leaving as an example - remove or implement.
 */
	public function view($id = null) {
		if (!$this->Archive->exists($id)) {
			throw new NotFoundException(__('Invalid archive'));
		}
		$options = array('conditions' => array('Archive.' . $this->Archive->primaryKey => $id));
		$this->set('archive', $this->Archive->find('first', $options));
	}

/**
 * generateArchive method
 *
 */

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
}
