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
     * index method
     *
     * @return void
     */
    public function index() {
        //Recent documents list
        $this->loadModel('Document');
        $documents = $this->Document->query("SELECT distinct Documenttype.type, Document.id, Document.applicant_id, Document.ancestortype_id, Document.filename, Document.copy_type, Document.applicant_id, Document.ancestortype_id,Document.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM documents AS Document, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, documenttypes AS Documenttype
            WHERE Document.archive_id = Archive.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Document.documenttype_id = Documenttype.id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
            ORDER BY Document.id DESC ");

        $this->set(compact('documents'));
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
        $this->loadModel('Clientcase');

        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $userid),'fields' => array('Clientcase.id','archive_id')));

        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL));
        $this->set('ancestordocuments', $this->Document->find('all', $options));

        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL), 'order'=>'applicant_id ASC');
        $this->set('applicantdocuments', $this->Document->find('all', $options));

        //For uploading
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Ancestortype');
        $this->loadModel('Documenttype');

        /*if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Clientcase');
            $this->loadModel('Archive');

            $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $id), 'fields' => array('Clientcase.id', 'Clientcase.archive_id'), 'recursive' => -1));
            $this->set('Clientcase');
            $test = $clientcase['Clientcase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->Documenttype->find('first', array('conditions' => array('Documenttype.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('Documenttype.id', 'Documenttype.code')));
            $ancestortype = $this->Ancestortype->find('first', array('conditions' => array('Ancestortype.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['Documenttype']['code'], $ancestortype['Ancestortype']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                //$this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
            }
        }*/
        $documentTypes = $this->Documenttype->find('list', array('fields' => array('Documenttype.id', 'Documenttype.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->Ancestortype->find('list', array('fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type'), 'order'=>'ancestor_type ASC'));
        $applicants = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));

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
        $this->loadModel('Ancestortype');
        $this->loadModel('Documenttype');

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Clientcase');
            $this->loadModel('Archive');

            $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $id), 'fields' => array('Clientcase.id', 'Clientcase.archive_id'), 'recursive' => -1));
            $this->set('Clientcase');
            $test = $clientcase['Clientcase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->Documenttype->find('first', array('conditions' => array('Documenttype.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('Documenttype.id', 'Documenttype.code')));
            $ancestortype = $this->Ancestortype->find('first', array('conditions' => array('Ancestortype.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['Documenttype']['code'], $ancestortype['Ancestortype']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            }
        }
        $documentTypes = $this->Documenttype->find('list', array('fields' => array('Documenttype.id', 'Documenttype.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->Ancestortype->find('list', array('fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type'), 'order'=>'ancestor_type ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes'));
    }

    public function uploadapplicant() {
        $id=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Documenttype');
        $this->loadModel('Clientcase');
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $id), 'fields' => array('Clientcase.id', 'Clientcase.archive_id'), 'recursive' => -1));
        $this->set('Clientcase');

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Archive');


            $test = $clientcase['Clientcase']['archive_id'];
            $this->request->data['Document']['archive_id'] = $test;

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->Documenttype->find('first', array('conditions' => array('Documenttype.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('Documenttype.id', 'Documenttype.code')));
            $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $this->request->data['Document']['applicant_id']),'fields' => array('Applicant.id', 'Applicant.first_name'),'recursive' => -1));

            if ($this->uploadDoc($archive, $doctype['Documenttype']['code'], $applicant['Applicant']['first_name']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'documents', 'action' => 'mydocs'));
            }
        }
        $documentTypes = $this->Documenttype->find('list', array('fields' => array('Documenttype.id', 'Documenttype.type'), 'order'=>'type ASC'));
        $applicants = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes', 'applicants'));
    }

    public function staffuploadan() {
        $this->loadModel('Ancestortype');
        $this->loadModel('Documenttype');

        $clientcase_id = $this->request->data['Document']['clientcase_id'];

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Clientcase');
            $this->loadModel('Archive');

            $clientcase = $this->Clientcase->findById($clientcase_id);
            $this->request->data['Document']['archive_id'] = $clientcase['Clientcase']['archive_id'];

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->Documenttype->find('first', array('conditions' => array('Documenttype.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('Documenttype.id', 'Documenttype.code')));
            $ancestortype = $this->Ancestortype->find('first', array('conditions' => array('Ancestortype.id' => $this->request->data['Document']['ancestortype_id']),'fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type')));

            if ($this->uploadDoc($archive, $doctype['Documenttype']['code'], $ancestortype['Ancestortype']['ancestor_type']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $clientcase_id, '#'=>'tab5'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $clientcase_id, '#'=>'tab5'));
            }
        }
    }

    public function staffuploadapp() {
        $this->loadModel('Applicant');
        $this->loadModel('Documenttype');
        $this->loadModel('Clientcase');

        $clientcase_id = $this->request->data['Document']['clientcase_id'];
        $clientcase = $this->Clientcase->findById($clientcase_id);

        if ($this->request->is('post')) {
            $this->Document->create();
            $this->loadModel('Archive');

            $this->request->data['Document']['archive_id'] = $clientcase['Clientcase']['archive_id'];

            $archive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $this->request->data['Document']['archive_id']),'fields' => array('Archive.id', 'Archive.archive_name')));
            $doctype = $this->Documenttype->find('first', array('conditions' => array('Documenttype.id' => $this->request->data['Document']['documenttype_id']),'fields' => array('Documenttype.id', 'Documenttype.code')));
            $applicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $this->request->data['Document']['applicant_id']),'fields' => array('Applicant.id', 'Applicant.first_name'),'recursive' => -1));

            if ($this->uploadDoc($archive, $doctype['Documenttype']['code'], $applicant['Applicant']['first_name']) && $this->Document->save($this->data)) {
                $this->Session->setFlash(__('The document was uploaded successfully'),'default', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $clientcase_id, '#'=>'tab5'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
                $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $clientcase_id, '#'=>'tab5'));
            }
        }
        $documentTypes = $this->Documenttype->find('list', array('fields' => array('Documenttype.id', 'Documenttype.type'), 'order'=>'type ASC'));
        $applicants = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));
        $this->set(compact('documentTypes', 'ancestorTypes', 'applicants'));
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
        $this->loadModel('Archive');
        $document = $this->Document->findById($id);
        $archive = $this->Archive->findById($document['Document']['archive_id']);
        $archivename = str_replace('/', '-', $archive['Archive']['archive_name']);
        $this->response->file('documents'.DS.$archivename.DS.$document['Document']['filename'], array('download' => true, 'name' => $document['Document']['filename']));
        //Return response object to prevent controller from trying to render a view
        return $this->response;
    }
    
    
   
    public function addphydoc(){
        $this->loadModel('Clientcase');
        $this->loadModel('Archive');

        $id = $this->request->data['Document']['clientcase_id'];


        $this->request->data['Document']['date_received'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Document']['dateReceived'])));

        $clientcase = $this->Clientcase->findById($id);
        $this->request->data['Document']['archive_id'] = $clientcase['Clientcase']['archive_id'];

        if($this->Document->save($this->data))
        {
            $this->Session->setFlash(__('The document has been saved'),'default', array('class' => 'alert-success'));
            $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id, '#'=>'tab5'));
        }
        else {
            $this->Session->setFlash(__('The document could not be saved. Please try again.'),'default', array('class' => 'alert-danger'));
            $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id, '#'=>'tab5'));
        }
    }

    public function editdate(){

        if ($this->request->is('post') || $this->request->is('put')){
            $this->request->data['Document']['date_returned'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Document']['dateReturned'])));
            if ($this->Document->save($this->request->data)){
                $this->Session->setFlash(__('The date has been updated'),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Document']['clientcase_id'], '#'=>'tab5'));
            }
            $this->Session->setFlash(__('Unable to update the return date'));
        }

    }
    
    public function report()
    {
        $this->loadModel('Document');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Document']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Document']['date2'])));

        $data = $this->Document->query("SELECT distinct Documenttype.type, Document.id, Document.applicant_id, Document.ancestortype_id, Document.filename, Document.copy_type, Document.applicant_id, Document.ancestortype_id,Document.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM documents AS Document, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, documenttypes AS Documenttype
                WHERE Document.archive_id = Archive.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Document.documenttype_id = Documenttype.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Document.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Document.created, '%Y%m%d') <= ".$date2."
                ORDER BY Document.id DESC");
        $this->set(compact('data'));
    }
}
