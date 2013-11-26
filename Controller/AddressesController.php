<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Addresses Controller
 *
 * @property Address $Address
 * @property PaginatorComponent $Paginator
 */
class AddressesController extends AppController {

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
		$this->Address->recursive = 0;
		$this->set('addresses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Address->exists($id)) {
			throw new NotFoundException(__('Invalid address'));
		}
		$options = array('conditions' => array('Address.' . $this->Address->primaryKey => $id));
		$this->set('address', $this->Address->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
        $this->loadModel('Clientcase');
        $this->loadModel('Country');
        $this->request->data['Address']['applicant_id'] = $id;
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.applicant_id' => $id)));
		if ($this->request->is('post')) {
			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The address has been saved', null),'default', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $clientcase['Clientcase']['id']));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
		//$applicants = $this->Address->Applicant->find('list');
		$countries = $this->Country->find('list');
        $this->set(compact('countries'));
		//$this->set(compact('applicants', 'countries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        //$this->loadModel('Clientcase');
        $this->loadModel('Applicant');
        $this->loadModel('Address');
        /*$applicant = $this->Applicant->query("SELECT distinct Applicant.id,
         FROM applicants AS Applicant, addresses AS Address
         WHERE Address.id = ".$id." AND Address.applicant_id = Applicant.id;"); */
        $address = $this->Address->find('first', array('conditions' => array('Address.id' => $id)));
        $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $address['Address']['applicant_id'])));
        $this->request->data['Address']['applicant_id'] = $address['Address']['applicant_id'];

		if (!$this->Address->exists($id)) {
			throw new NotFoundException(__('Invalid address'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

            $this->Address->create();
			if ($this->Address->save($this->request->data)) {
				$this->Session->setFlash(__('The address has been saved', null),'default', array('class' => 'alert-success'));

                $this->Address->set('id', $id);
                $this->request->data['Address']['date_changed'] = date('y-m-d');
                $this->Address->save($this->request->data);

				return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $applicant['Applicant']['clientcase_id']));
			} else {
				$this->Session->setFlash(__('The address could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
			}
        }

			$options = array('conditions' => array('Address.' . $this->Address->primaryKey => $id));
			$this->request->data = $this->Address->find('first', $options);

		//$applicants = $this->Address->Applicant->find('list');
		$countries = $this->Address->Country->find('list', array('fields' => array('Country.id', 'Country.country_name')));
		$this->set(compact('applicant', 'countries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			throw new NotFoundException(__('Invalid address'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Address->delete()) {
			$this->Session->setFlash(__('Address deleted', null),'default', array('class' => 'alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Address was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
