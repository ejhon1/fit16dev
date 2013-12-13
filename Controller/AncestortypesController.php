<?php
App::uses('AppController', 'Controller');
/**
 * Ancestortypes Controller
 *
 * Used by documents as a category.
 * An index can be viewed by staff in the admin dashboard management page (view/users/management)
 */
class AncestortypesController extends AppController {

/**
 * add method
 *
 * Accessed by staff via management page.
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ancestortype->create();
			if ($this->Ancestortype->save($this->request->data)) {
				$this->Session->setFlash(__('The ancestor type has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect('../management');
			} else {
				$this->Session->setFlash(__('The ancestor type could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 *  Accessed by staff via management page.
 */
	public function edit($id = null) {
		if (!$this->Ancestortype->exists($id)) {
			throw new NotFoundException(__('Invalid ancestortype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ancestortype->save($this->request->data)) {
				$this->Session->setFlash(__('The ancestor type has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect('../management');
			} else {
				$this->Session->setFlash(__('The ancestor type could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
			}
		}
			$options = array('conditions' => array('Ancestortype.' . $this->Ancestortype->primaryKey => $id));
			$this->request->data = $this->Ancestortype->find('first', $options);
	}

/**
 * delete method
 *
 *  Accessed by staff via management page.
 */
	public function delete($id = null) {
		$this->Ancestortype->id = $id;
		if (!$this->Ancestortype->exists()) {
			throw new NotFoundException(__('Invalid ancestortype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ancestortype->delete()) {
			$this->Session->setFlash(__('Ancestor type deleted', null),'default', array('class' => 'alert-success'));
            return $this->redirect('../management');
		}
		$this->Session->setFlash(__('Ancestor type was not deleted', null),'default', array('class' => 'alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
}
