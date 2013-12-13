<?php
App::uses('AppController', 'Controller');
/**
 * Casestatuses Controller
 *
 * Used to connect statuses to cases, to form a log of past statuses for each case.
 *
 * @property Casestatus $Casestatus
 * @property PaginatorComponent $Paginator
 */
class CasestatusesController extends AppController {

	public $components = array('Paginator');

/* updatestatus method
 *
 * Used to update the status of a case.
 * Creates a new entry that records case id, status id, and the date.
 */

    public function updatestatus()
    {
        $this->loadModel('Casestatus');
        $this->loadModel('Clientcase');

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
    }
}
