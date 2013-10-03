<?php
App::uses('AppController', 'Controller');
/**
 * Documents Controller
 *
 * @property Document $Document
 * @property PaginatorComponent $Paginator
 */
class DocumentsController extends AppController {

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
        $this->Document->recursive = 0;
        $this->set('documents', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Document->exists($id)) {
            throw new NotFoundException(__('Invalid document'));
        }
        $options = array('conditions' => array('Document.' . $this->Document->primaryKey => $id));
        $this->set('document', $this->Document->find('first', $options));
    }

    public function mydocs() {
        $this->loadModel('Applicant');
        $userid = $this->UserAuth->getUserId();
        $this->loadModel('ClientCase');

        $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $userid),'fields' => array('ClientCase.id','archive_id')));

        $options = array('conditions' => array('Document.archive_id' => $clientcase['ClientCase']['archive_id'], 'Document.applicant_id' => NULL));
        $this->set('ancestordocuments', $this->Document->find('all', $options));

        $options = array('conditions' => array('Document.archive_id' => $clientcase['ClientCase']['archive_id'], 'Document.ancestortype_id' => NULL), 'order'=>'applicant_id ASC');
        $this->set('applicantdocuments', $this->Document->find('all', $options));

        //For uploading
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('AncestorType');
        $this->loadModel('DocumentType');

        /*if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('ClientCase');
            $this->loadModel('Archive');

            $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $id), 'fields' => array('ClientCase.id', 'ClientCase.archive_id'), 'recursive' => -1));
            $this->set('ClientCase');
            $test = $clientcase['ClientCase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('DocumentType.id', 'DocumentType.code')));
            $ancestortype = $this->AncestorType->find('first', array('conditions' => array('AncestorType.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('AncestorType.id', 'AncestorType.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['DocumentType']['code'], $ancestortype['AncestorType']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                //$this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
            }
        }*/
        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor_type'), 'order'=>'ancestor_type ASC'));
        $applicants = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['ClientCase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));

        $this->set(compact('documentTypes', 'ancestorTypes', 'applicants'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Document->create();
            if ($this->Document->save($this->request->data)) {
                $this->Session->setFlash(__('The document has been saved'),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please, try again.'),'default', array('class' => 'alert-danger'));
            }
        }
        $archives = $this->Document->Archive->find('list');
        $applicants = $this->Document->Applicant->find('list');
        $ancestortypes = $this->Document->Ancestortype->find('list');
        $documenttypes = $this->Document->Documenttype->find('list');
        $this->set(compact('archives', 'applicants', 'ancestortypes', 'documenttypes'));
    }

    public function uploadancestor() {
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('AncestorType');
        $this->loadModel('DocumentType');

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('ClientCase');
            $this->loadModel('Archive');

            $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $id), 'fields' => array('ClientCase.id', 'ClientCase.archive_id'), 'recursive' => -1));
            $this->set('ClientCase');
            $test = $clientcase['ClientCase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('DocumentType.id', 'DocumentType.code')));
            $ancestortype = $this->AncestorType->find('first', array('conditions' => array('AncestorType.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('AncestorType.id', 'AncestorType.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['DocumentType']['code'], $ancestortype['AncestorType']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            }
        }
        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor_type'), 'order'=>'ancestor_type ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes'));
    }

    public function uploadapplicant() {
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('DocumentType');
        $this->loadModel('ClientCase');
        $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $id), 'fields' => array('ClientCase.id', 'ClientCase.archive_id'), 'recursive' => -1));
        $this->set('ClientCase');

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Archive');


            $test = $clientcase['ClientCase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('DocumentType.id', 'DocumentType.code')));
            $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $this->request->data['Document']['applicant_id']),'fields' => array('Applicant.id', 'Applicant.first_name'),'recursive' => -1));

            if ($this->uploadDoc($archive, $doctype['DocumentType']['code'], $applicant['Applicant']['first_name']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            }
        }
        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.type'), 'order'=>'type ASC'));
        $applicants = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['ClientCase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes', 'applicants'));
    }

    public function uploadfile()
    {
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('AncestorType');
        $this->loadModel('DocumentType');
        $this->loadModel('Applicant');
        $this->loadModel('ClientCase');
        $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $id), 'fields' => array('ClientCase.id', 'ClientCase.archive_id'), 'recursive' => -1));
        $this->set('ClientCase');


        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('ClientCase');
            $this->loadModel('Archive');
            $this->loadModel('DocumentType');
            $this->loadModel('Applicant');
            $this->loadModel('AncestorType');

            $clientcase = $this->ClientCase->find('first', array('conditions' => array('ClientCase.user_id' => $id), 'fields' => array('ClientCase.id', 'ClientCase.archive_id'), 'recursive' => -1));
            $this->set('ClientCase');
            $test = $clientcase['ClientCase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('DocumentType.id', 'DocumentType.code')));
            $ancestortype = $this->AncestorType->find('first', array('conditions' => array('AncestorType.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('AncestorType.id', 'AncestorType.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['DocumentType']['code'], $ancestortype['AncestorType']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                //$this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                //$this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
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
        if (!$this->Document->exists($id)) {
            throw new NotFoundException(__('Invalid document'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Document->save($this->request->data)) {
                $this->Session->setFlash(__('The document has been saved'),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please, try again.'),'default', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Document.' . $this->Document->primaryKey => $id));
            $this->request->data = $this->Document->find('first', $options);
        }
        $archives = $this->Document->Archive->find('list');
        $applicants = $this->Document->Applicant->find('list');
        $ancestortypes = $this->Document->Ancestortype->find('list');
        $documenttypes = $this->Document->Documenttype->find('list');
        $this->set(compact('archives', 'applicants', 'ancestortypes', 'documenttypes'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Document->id = $id;
        if (!$this->Document->exists()) {
            throw new NotFoundException(__('Invalid document'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Document->delete()) {
            $this->Session->setFlash(__('Document deleted'),'default', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Document was not deleted'),'default', array('class' => 'alert-danger'));
        return $this->redirect(array('action' => 'index'));
    }

    public function uploadDoc($archive, $doctype, $ancestortype) {
        $file = $this->request->data['Document']['file'];

        $archivename = str_replace('/', '-', $archive['Archive']['archive_name']);

        $uploadFolder = APP.'documents' . DS . $archivename;
        $ext = substr(strrchr($file['name'], '.'), 1);

        $filename = $archivename.' '.$ancestortype.' '.$doctype.' '.date('d-m-y');
        $fullname = $filename.'.'. $ext;

        $i = 1;
        $available = false;
        do
        {
            $conditions = array('Document.filename' => $fullname);

            if($this->Document->hasAny($conditions))
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
            $this->request->data['Document']['filename'] = $filename;
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
        //Return response object to prevent controller from trying to render a view
        return $this->response;
    }
}
