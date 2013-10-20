<?php
App::uses('AppController', 'Controller');
/**
 * Clientcases Controller
 *
 * @property Clientcase $Clientcase
 * @property PaginatorComponent $Paginator
 */
class ClientcasesController extends AppController {

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
    public function index($id = null) {
        $this->loadModel('Status');
        $this->Clientcase->recursive = 0;
        if(empty($id))
        {
            $clientcases =  $this->Clientcase->find('all');
        }
        else
        {
            $clientcases =  $this->Clientcase->find('all', array('conditions' => array('Clientcase.status_id' => $id)));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            return $this->redirect(array('controller' => 'clientcases', 'action' => 'index', $this->request->data['Clientcases']['status_id']));

        }

        $statuses = $this->Status->find('list');
        $this->set(compact('statuses','clientcases', 'id'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');
        $this->loadModel('DocumentType');
        $this->loadModel('AncestorType');
        $this->loadModel('Archive');
        $this->loadModel('User');
        $this->loadModel('Address');

        $documentTypes = $this->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->AncestorType->find('list', array('fields' => array('AncestorType.id', 'AncestorType.ancestor_type'), 'order'=>'ancestor_type ASC'));



        $statuses = $this->Casestatus->Status->find('list');
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));

        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));

        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Archiveloan->save($this->request->data);
        }
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $archivecount = $this->Clientcase->find('count', array('conditions' => array('Clientcase.archive_id' =>$clientcase['Clientcase']['archive_id'])));

		
		$applicantslist = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));
        
        $options = array('conditions' => array('User.id' => $clientcase['Clientcase']['user_id']));
        $this->set('updateAppointmentDate', $this->User->find('all', $options));
        
        //$applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $id), 'order'=>'first_name ASC', 'recursive' => -1));
        $mainapplicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id'])));

        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id'], 'NOT' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id']))));

        $address = $this->Address->find('first', array('conditions' => array('Address.applicant_id' => $id, 'Address.date_changed' => NULL)));        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL, 'Document.copy_type' => 'Digital'));
        $this->set('ancestordocuments', $this->Document->find('all', $options), $this->Paginator->paginate());


        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL, 'NOT' => array('Document.copy_type' => 'Digital')));
        $this->set('physicalancdocuments', $this->Document->find('all', $options), $this->Paginator->paginate());

        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL, 'NOT' => array('Document.copy_type' => 'Digital')), 'order'=>'applicant_id ASC');
        $this->set('physicalappdocuments', $this->Document->find('all', $options), $this->Paginator->paginate());


        $options = array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL, 'Document.copy_type' => 'Digital'), 'order'=>'applicant_id ASC');
        $this->set('applicantdocuments', $this->Document->find('all', $options), $this->Paginator->paginate());
        $casestatuses = $this->Casestatus->find('all', array('conditions' => array('Casestatus.clientcase_id' => $clientcase['Clientcase']['id']), 'order' => array('Casestatus.date_updated DESC')));
        $currentloan = $this->Archiveloan->find('first', array('conditions' => array('Archiveloan.archive_id' => $clientcase['Clientcase']['archive_id'], 'Archiveloan.date_returned' => NULL)));
        $user = $this->User->find('first', array('conditions' => array('User.id' => $clientcase['Clientcase']['user_id'])));


        $addresses = $this->Address->find('all', array('conditions' => array('Address.applicant_id' => $clientcase['Clientcase']['applicant_id'])));
        
        $this->set(compact('clientcase', 'applicants', 'currentloan', 'employee', 'casestatuses', 'statuses', 'id', 'documentTypes', 'ancestorTypes', 'applicantslist', 'user', 'addresses', 'archivecount', 'address', 'mainapplicant'));
    }

    public function statustest($id = null) {
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');

        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
        $clientcases = $this->Casestatus->Clientcase->find('list');
        $statuses = $this->Casestatus->Status->find('list');
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));

        }
        /*if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Casestatus']['clientcase_id'] = $id;
            $this->request->data['Casestatus']['employee_id'] = $employee['Employee']['id'];
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }*/
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $casestatuses = $this->Casestatus->find('all', array('conditions' => array('Casestatus.clientcase_id' => $clientcase['Clientcase']['id'])));

        $this->set(compact('clientcase',  'employee', 'casestatuses', 'clientcases', 'statuses', 'id'));
    }

    public function updatestatus()
    {
        /*$this->loadModel('Casestatus');
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }
        */
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');

        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));
        $clientcases = $this->Casestatus->Clientcase->find('list');
        $statuses = $this->Casestatus->Status->find('list');
        /*if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Casestatus']['clientcase_id'] = $id;
            $this->request->data['Casestatus']['employee_id'] = $employee['Employee']['id'];
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }*/
        if ($this->request->is('post')) {
            $this->Casestatus->create();
            if ($this->Casestatus->save($this->request->data, false)) {
                $this->Session->setFlash(__('The case status has been saved'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Casestatus']['clientcase_id']));
            } else {
                $this->Session->setFlash(__('The case status could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('clientcase',  'employee', 'casestatuses', 'clientcases', 'statuses', 'id'));
    }
    
    public function editAppointmentDate($id=null) {
        if ($this->request->is('post')|| $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data, false)) {
                $this->Session->setFlash(__('The Appointment Date has been edited', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));
            } else {
                $this->Session->setFlash(__('The Appointment Date could not be edited. Please, try again.', null),'default', array('class' => 'alert-danger'));

            }
        }
    }
    
    public function updateAppointmentDate($id=null) {
        if ($this->request->is('post')|| $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data, false)) {
                $this->Session->setFlash(__('The Appointment Date has been updated', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));
            } else {
                $this->Session->setFlash(__('The Appointment Date could not be updated. Please, try again.', null),'default', array('class' => 'alert-danger'));

            }
        }
    }
    
    public function changeMainApplicant()
    {
        $this->loadModel('Applicant');
        if ($this->request->is('post')|| $this->request->is('put')) {

            $applicant = $this->Applicant->findByid($this->request->data['Clientcase']['applicant_id']);

            if(empty($applicant['Applicant']['email']))
            {
                $this->Session->setFlash(__('Applicant must have an email address before it can become the main applicant', null),'default', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $applicant['Applicant']['clientcase_id']));
            }
            if ($this->Clientcase->save($this->request->data, false))
            {
                $this->Session->setFlash(__('The main applicant was changed', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));

            }
            else {
                $this->Session->setFlash(__('The main applicant could not be changed.', null),'default', array('class' => 'alert-danger'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $applicant['Applicant']['clientcase_id']));
            }

        }
    }
    
    public function updateOpenClose($id=null) {
        if ($this->request->is('post')|| $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data, false)) {
                $this->Session->setFlash(__('The Case Information has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));
            } else {
                $this->Session->setFlash(__('The Case Information could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));

            }
        }
    }

    public function myaccount() {
        $id=$this->Session->read('UserAuth.User.id');
        //$options = array('conditions' => array('Clientcase.user_id' => $id));
        //$this->set('clientcase', $this->Clientcase->find('first', $options));
        $this->loadModel('Clientcase');
        $this->loadModel('Applicant');
        $this->loadModel('Address');

        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.user_id' => $id)));

        $mainapplicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id'])));

        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id'], 'NOT' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id']))));

        $address = $this->Address->find('first', array('conditions' => array('Address.applicant_id' => $id, 'Address.date_changed' => NULL)));

        $this->set(compact('clientcase', 'mainapplicant', 'applicants', 'address'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Clientcase->create();
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The client case has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client case could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
        $users = $this->Clientcase->User->find('list');
        $archives = $this->Clientcase->Archive->find('list');
        $statuses = $this->Clientcase->Status->find('list');
        $applicants = $this->Clientcase->Applicant->find('list');
        $this->set(compact('users', 'archives', 'statuses', 'applicants'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Client Case'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The client case has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client case could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id));
            $this->request->data = $this->Clientcase->find('first', $options);
        }
        $users = $this->Clientcase->User->find('list');
        $archives = $this->Clientcase->Archive->find('list');
        $statuses = $this->Clientcase->Status->find('list');
        $applicants = $this->Clientcase->Applicant->find('list');
        $this->set(compact('users', 'archives', 'statuses', 'applicants'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Clientcase->id = $id;
        if (!$this->Clientcase->exists()) {
            throw new NotFoundException(__('Invalid client case'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Clientcase->delete()) {
            $this->Session->setFlash(__('Client case deleted', null),'default', array('class' => 'alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client case was not deleted', null),'default', array('class' => 'alert-danger'));
        return $this->redirect(array('action' => 'index'));
    }
    public function merge($id = null) {
        $this->loadModel('Archive');
        $this->loadModel('Clientcase');
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid case'));
        }

        if ($this->request->is('post') || $this->request->is('put'))
        {
            $archive = $this->Archive->find('first', array('conditions' => array('Archive.archive_name' => $this->request->data['Clientcase']['archive_name'])));
            if(!empty($archive))
            {
                $clientcase =  $this->Clientcase->find('first', array('conditions' => array('Clientcase.archive_id' => $archive['Archive']['id'])));
            }
            else
            {
                $this->Session->setFlash(__('That is not a valid archive name', null),'default', array('class' => 'alert-danger'));
            }
            $this->set(compact('clientcase'));
        }
        $this->set(compact('id'));
    }
    public function performmerge() {
        $this->loadModel('Archive');
        $this->loadModel('Clientcase');
        $this->loadModel('Archiveloan');
        $this->loadModel('Document');
        $current_client_id = $this->request->data['Clientcase']['new_clientcase_id'];
        $merging_archive_id  = $this->request->data['Clientcase']['old_archive_id'];
        $currentclientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.id' => $current_client_id), 'fields' => array('id', 'archive_id')));
        $current_archive_id = $currentclientcase['Clientcase']['archive_id'];

        $archiveloans = $this->Archiveloan->find('all', array('conditions' => array('Archiveloan.archive_id' => $current_archive_id)));

        $currentarchive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $current_archive_id)));
        $mergingarchive = $this->Archive->find('first', array('conditions' => array('Archive.id' => $merging_archive_id)));

        if($merging_archive_id != $current_archive_id)
        {


            foreach ($archiveloans as $archiveloan):
            $this->Archiveloan->id = $archiveloan['Archiveloan']['id'];
            $this->Archiveloan->delete();
            endforeach;

            $this->request->data['Clientcase']['id'] = $current_client_id;
            $this->request->data['Clientcase']['archive_id'] = $merging_archive_id;

            $this->Clientcase->save($this->request->data);

            //Copy/move docs to older archive, delete folder etc.
            $documents = $this->Document->find('all', array('conditions' => array('Document.archive_id' => $current_archive_id)));

            $currentarchivename = str_replace('/', '-', $currentarchive['Archive']['archive_name']);
            $mergingarchivename = str_replace('/', '-', $mergingarchive['Archive']['archive_name']);
            $uploadFolder = APP.'documents' . DS . $mergingarchivename;

            if( !file_exists($uploadFolder) ){
                mkdir($uploadFolder);
            }
            foreach ($documents as $document):
                if(!empty($document['Document']['applicant_id']))
                {
                    $type = $document['Applicant']['first_name'];
                }
                else{
                    $type = $document['Ancestortype']['ancestor_type'];
                }
                $ext = substr(strrchr($document['Document']['filename'], '.'), 1);
                $newfilename = $mergingarchivename.' '.$type.' '.$document['Documenttype']['code'].' '.date('d-m-y');
                $fullname = $newfilename.'.'. $ext;

                $i = 0;
                $available = false;
                do
                {
                    $conditions = array('Document.filename' => $fullname);

                    if($this->Document->hasAny($conditions))
                    {
                        $i++;
                        $fullname = $newfilename.' '.$i.'.'.$ext;
                    }
                    else
                    {
                        $available = true;
                    }
                }while(!$available);

                $newfilename = $fullname;

                $this->Document->id = $document['Document']['id'];
                $this->request->data['Document']['archive_id'] = $merging_archive_id;
                if($document['Document']['copy_type'] == 'Digital')
                {
                    $file = new File( APP.'documents'.DS.$currentarchivename.DS.$document['Document']['filename']);

                    $dir = new Folder($uploadFolder);
                    $file->copy($dir->path . DS . $newfilename);

                    $this->request->data['Document']['filename'] = $newfilename;
                }
                $this->Document->save($this->request->data);

            endforeach;
            $delFolder = APP.'documents' . DS . $currentarchivename;
            if(file_exists( $delFolder))
            {
                $oldfolder = new Folder($delFolder);
                $oldfolder->delete();
            }
            $this->Session->setFlash(__('The archives were successfully merged', null),'default', array('class' => 'alert-success'));

            return $this->redirect(array('action' => 'view', $current_client_id));
        }
        else
        {
            $this->Session->setFlash(__('You cannot merge an archive with itself.'),'default', array('class' => 'alert-danger'));
            return $this->redirect(array('action' => 'view', $current_client_id));
        }

    }
    public function reporting()
    {
        $this->loadModel('Casenote');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');
        $this->loadModel('Docnote');

        $casenotes = $this->Casenote->query("SELECT distinct Clientcase.id, Casenote.subject, Casenote.created, Applicant.first_name, Applicant.surname, Archive.archive_name
            FROM casenotes AS Casenote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
            WHERE Casenote.clientcase_id = Clientcase.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Casenote.id IN(
            SELECT MAX(casenotes.id)
            FROM casenotes
            GROUP BY casenotes.clientcase_id
        );");


        if ($this->request->is('post')) {
            $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
            $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

            $noSucEnq = $this->Clientcase->find('count', array('conditions' => array('DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2)));
            $noDenEnq = 0;
            $noCaseNotes =$this->Casenote->find('count', array('conditions' => array('DATE_FORMAT(Casenote.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Casenote.created, "%Y%m%d") <= '.$date2)));
            $noDocsDown =$this->Document->find('count', array('conditions' => array('DATE_FORMAT(Document.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Document.created, "%Y%m%d") <= '.$date2)));
            $noDocNotes = $this->Docnote->find('count', array('conditions' => array('DATE_FORMAT(Docnote.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Docnote.created, "%Y%m%d") <= '.$date2)));


            $clientcases = $this->Clientcase->find('all', array('conditions' => array('DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2)));


            //    $date2 = $this->request->data['Clientcase']['date2'];
        }


        //if ($this->request->is('post') || $this->request->is('put')) {

        //    $this->report();
        //}

        $this->set(compact('casenotes', 'date1', 'noSucEnq', 'noDenEnq', 'noCaseNotes', 'noDocsDown', 'noDocNotes', 'clientcases'));
    }
    public function report()
    {
        $this->loadModel('Clientcase');

        $data = $this->Clientcase->find('all');



        $this->set(compact('data'));
    }
}
