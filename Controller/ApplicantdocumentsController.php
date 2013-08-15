<?php
App::uses('AppController', 'Controller');
/**
 * Applicantdocuments Controller
 *
 * @property Applicantdocument $Applicantdocument
 */
class ApplicantdocumentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Applicantdocument->recursive = 0;
		$this->set('applicantdocuments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Applicantdocument->exists($id)) {
			throw new NotFoundException(__('Invalid applicantdocument'));
		}
		$options = array('conditions' => array('Applicantdocument.' . $this->Applicantdocument->primaryKey => $id));
		$this->set('applicantdocument', $this->Applicantdocument->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 
	public function add() {
		if ($this->request->is('post')) {
			$this->Applicantdocument->create();
			if ($this->Applicantdocument->save($this->request->data)) {
				$this->Session->setFlash(__('The applicantdocument has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicantdocument could not be saved. Please, try again.'));
			}
		}
		$archives = $this->Applicantdocument->Archive->find('list');
		$applicants = $this->Applicantdocument->Applicant->find('list');
		$this->set(compact('archives', 'applicants'));
	}
	*/
	
	public function upload() {
		if ($this->request->is('post')) {
			$this->Document->create();
			if ($this->uploadDoc() && $this->Document->save($this->data)) {
				$this->Session->setFlash(__('The document was uploaded successfully'));
				if($this->Auth->user('role') == 9)
				{
					$this->redirect(array('action' => 'myDocuments'));
				}
				else
				{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please try again.'));
			}
		}
		//$antypes = $this->Document->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor'), 'order'=>'ancestor ASC'));
		$users = $this->Document->User->find('list');
		$documentTypes = $this->Document->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.doc_type'), 'order'=>'doc_type ASC'));
		$ancestorTypes = $this->Document->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor'), 'order'=>'ancestor ASC'));
		$this->set(compact('users', 'documentTypes', 'ancestorTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Applicantdocument->exists($id)) {
			throw new NotFoundException(__('Invalid applicantdocument'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Applicantdocument->save($this->request->data)) {
				$this->Session->setFlash(__('The applicantdocument has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The applicantdocument could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Applicantdocument.' . $this->Applicantdocument->primaryKey => $id));
			$this->request->data = $this->Applicantdocument->find('first', $options);
		}
		$archives = $this->Applicantdocument->Archive->find('list');
		$applicants = $this->Applicantdocument->Applicant->find('list');
		$this->set(compact('archives', 'applicants'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Applicantdocument->id = $id;
		if (!$this->Applicantdocument->exists()) {
			throw new NotFoundException(__('Invalid applicantdocument'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Applicantdocument->delete()) {
			$this->Session->setFlash(__('Applicantdocument deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Applicantdocument was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function uploadDoc() {
 		$file = $this->request->data['Document']['file'];
	 
		//if ( $uploadData['size'] == 0 || $uploadData['error'] !== 0) {
		//    return false;
		//}
	 
		$userfolder = $this->request->data['Document']['user_id'];
		$uploadFolder = APP.'documents' . DS . $userfolder;
		$ext = substr(strrchr($file['name'], '.'), 1);
		$fileID = time();
		$fileName =  $fileID . '.' . $ext;

		if( !file_exists($uploadFolder) ){
			mkdir($uploadFolder);
		}
		
		$uploadPath = $uploadFolder . DS . $fileName;
	 
		if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
			$this->request->data['Document']['id'] = $fileID;
			$this->request->data['Document']['user_id'] = $this->Auth->user('id');
			$this->request->data['Document']['uploader'] = $this->Auth->user('id');
			$this->request->data['Document']['filename'] = $file['name'];
			$this->request->data['Document']['filesize'] = $file['size'];
			$this->request->data['Document']['filemime'] = $file['type'];
			return true;
		}
	 
		return false;
	}
	public function sendFile($id) {
		$document = $this->Document->findById($id);
		$user = $document['Document']['user_id'];
		$filename = $document['Document']['filename'];
		$ext = substr(strrchr($filename, '.'), 1);
		$title = substr($filename, 0, strrpos($filename, '.'));
		$this->response->file(APP.'documents'.DS.$user.DS.$id.'.'.$ext, array('download' => true, 'name' => $title.'.'.$ext));
		//Return reponse object to prevent controller from trying to render a view
		return $this->response;
	}
}
