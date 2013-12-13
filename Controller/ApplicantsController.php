<?php
App::uses('AppController', 'Controller');
/**
 * Applicants Controller
 *
 * Used to record, edit and access information about applicants.
 */
class ApplicantsController extends AppController {

/**
 * add method
 *
 * Accessed by staff through the case page.
 * Adds an applicant to a case.
 */
	public function add($id = null) {
		$this->request->data['Applicant']['clientcase_id'] = $id;
		if ($this->request->is('post')) {
            $this->request->data['Applicant']['birthdate'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Applicant']['birthdate'])));

            $this->Applicant->create();
			if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash(__('The applicant has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		$clientcases = $this->Applicant->Clientcase->find('list');
		$this->set(compact('clientcases', 'archives'));
	}

/**
 * edit method
 *
 * Accessed by staff through the case page.
 * Edits information belonging to an applicant.
 */
	public function edit($id = null) {
	$this->loadModel('Applicant');
		if (!$this->Applicant->exists($id)) {
			throw new NotFoundException(__('Invalid applicant'));
		}
        $applicant = $this->Applicant->findByid($id);
        $test = date('d/m/Y', strtotime($applicant['Applicant']['birthdate']));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Applicant']['birthdate'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Applicant']['date'])));

            if ($this->Applicant->save($this->request->data)) {
				$this->Session->setFlash(__('The applicant has been saved', null),'default', array('class' => 'alert-success'));
				
				return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Applicant']['clientcase_id']));
			} else {
				$this->Session->setFlash(__('The applicant could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
        $options = array('conditions' => array('Applicant.' . $this->Applicant->primaryKey => $id));
        $this->request->data = $this->Applicant->find('first', $options);
		$this->set(compact('id', 'test'));
	}
}
