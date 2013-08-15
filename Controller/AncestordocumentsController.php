<?php
App::uses('AppController', 'Controller');
/**
 * Ancestordocuments Controller
 *
 * @property Ancestordocument $Ancestordocument
 */
class AncestordocumentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Ancestordocument->recursive = 0;
		$this->set('ancestordocuments', $this->paginate());
	}

    public function myDocuments() {
        $id = $this->Auth->user('id');
        $documents = $this->Ancestordocument->find('all', array('conditions' => array('user_id'=>$id)));
        $this->set('documents', $documents, $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ancestordocument->exists($id)) {
			throw new NotFoundException(__('Invalid ancestordocument'));
		}
		$options = array('conditions' => array('Ancestordocument.' . $this->Ancestordocument->primaryKey => $id));
		$this->set('ancestordocument', $this->Ancestordocument->find('first', $options));
	}

	public function upload() {
        $id = $this->Auth->user('id');
        $this->loadModel('AncestorType');
        $this->loadModel('DocumentType');

        if ($this->request->is('post')) {
            $this->Ancestordocument->create();
            $this->loadModel('Client');
            $this->loadModel('Archive');

            $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id), 'fields' => array('Client.id', 'Client.archive_id'), 'recursive' => 1));
            $this->set('client');
            $test = $client['Client']['archive_id'];
            $this->request->data['Ancestordocument']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Ancestordocument']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $this->request->data['Ancestordocument']['document_type']),'fields' => array('DocumentType.id', 'DocumentType.code')));
            $ancestortype = $this->AncestorType->find('first', array('conditions' => array('AncestorType.id' => $this->request->data['Ancestordocument']['ancestor_type']),'fields' => array('AncestorType.id', 'AncestorType.Ancestor')));

            if ($this->uploadDoc($archive, $doctype['DocumentType']['code'], $ancestortype['AncestorType']['Ancestor']) && $this->Ancestordocument->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'));
                    $this->redirect(array('controller' => 'Archives', 'action' => 'casedocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'));
            }
        }
        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.doc_type'), 'order'=>'doc_type ASC'));
        $ancestorTypes = $this->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor'), 'order'=>'ancestor ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */


	public function edit($id = null) {
		if (!$this->Ancestordocument->exists($id)) {
			throw new NotFoundException(__('Invalid ancestordocument'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ancestordocument->save($this->request->data)) {
				$this->Session->setFlash(__('The ancestordocument has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ancestordocument could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ancestordocument.' . $this->Ancestordocument->primaryKey => $id));
			$this->request->data = $this->Ancestordocument->find('first', $options);
		}
		$archives = $this->Ancestordocument->Archive->find('list');
		$this->set(compact('archives'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ancestordocument->id = $id;
		if (!$this->Ancestordocument->exists()) {
			throw new NotFoundException(__('Invalid ancestordocument'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ancestordocument->delete()) {
			$this->Session->setFlash(__('Ancestordocument deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ancestordocument was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function uploadDoc($archive, $doctype, $ancestortype) {
        $file = $this->request->data['Ancestordocument']['file'];

        $archivename = str_replace('/', '-', $archive['Archive']['archive_name']);

        $uploadFolder = APP.'documents' . DS . $archivename;
        $ext = substr(strrchr($file['name'], '.'), 1);

        $filename = $archivename.' '.$ancestortype.' '.$doctype;
        $fullname = $archivename.' '.$ancestortype.' '.$doctype.'.'. $ext;

        $i = 1;
        $available = false;
        do
        {
            $conditions = array('Ancestordocument.filename' => $fullname);

            if($this->Ancestordocument->hasAny($conditions))
            {
                $i++;
                $fullname = $filename.' '.$i.'.'.$ext;
            }
            else
            {
                $available = true;
            }
        }while(!$available);

        $filename = $fullname;

        if( !file_exists($uploadFolder) ){
            mkdir($uploadFolder);
        }

        $uploadPath = $uploadFolder . DS . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $this->request->data['Ancestordocument']['filename'] = $filename;
            $this->request->data['Ancestordocument']['filesize'] = $file['size'];
            $this->request->data['Ancestordocument']['filemime'] = $file['type'];
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
		//Return response object to prevent controller from trying to render a view
		return $this->response;
	}
}
