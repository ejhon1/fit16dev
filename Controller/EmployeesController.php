<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 * @property PaginatorComponent $Paginator
 */
class EmployeesController extends AppController {

    public $components = array('Paginator');


    /**
     * myaccount method
     *
     * Page viewed by staff members with their own account details.
     */
    public function myaccount() {
        $id=$this->Session->read('UserAuth.User.id');
        $options = array('conditions' => array('Employee.user_id' => $id));
        $this->set('employee', $this->Employee->find('first', $options));
    }
    /**
     * editaccount method
     *
     * Page used by staff members to update their own account details.
     */
    public function editaccount() {
        $id=$this->Session->read('UserAuth.User.id');
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Employee->save($this->request->data)) {
                $this->Session->setFlash(__('The employee has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'myaccount'));
            } else {
                $this->Session->setFlash(__('The employee could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Employee.user_id' => $id));
            $this->request->data = $this->Employee->find('first', $options);
        }
    }
}
