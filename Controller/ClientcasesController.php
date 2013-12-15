<?php
App::uses('AppController', 'Controller');
/**
 * Clientcases Controller
 *
 * @property Clientcase $Clientcase
 * @property PaginatorComponent $Paginator
 */
class ClientcasesController extends AppController {

    public $components = array('Paginator');

    /**
     * index method
     *
     * Displays a dynamically-searchable list of cases.
     * List can be filtered by status.
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
     * The case page for a client's case. Contains virtually all of the information relating to the case.
     */
    public function view($id = null) {
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Case.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Archiveloan->save($this->request->data);
        }
        $userid=$this->Session->read('UserAuth.User.id');
        $this->loadModel('Applicant');
        $this->loadModel('Document');
        $this->loadModel('Employee');
        $this->loadModel('Archiveloan');
        $this->loadModel('Casestatus');
        $this->loadModel('Status');
        $this->loadModel('Documenttype');
        $this->loadModel('Ancestortype');
        $this->loadModel('Archive');
        $this->loadModel('User');
        $this->loadModel('Address');

        //General variables
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $user = $this->User->find('first', array('conditions' => array('User.id' => $clientcase['Clientcase']['user_id'])));
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userid)));

        //Case information
        $currentloan = $this->Archiveloan->find('first', array('conditions' => array('Archiveloan.archive_id' => $clientcase['Clientcase']['archive_id'], 'Archiveloan.date_returned' => NULL)));
        $applicantslist = $this->Applicant->find('list', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id']),'fields' => array('Applicant.id', 'Applicant.first_name'), 'order'=>'first_name ASC'));
        $archivecount = $this->Clientcase->find('count', array('conditions' => array('Clientcase.archive_id' =>$clientcase['Clientcase']['archive_id'])));
        $mainapplicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id'])));
        $address = $this->Address->find('first', array('conditions' => array('Address.applicant_id' => $id, 'Address.date_changed' => NULL)));
        $applicants = $this->Applicant->find('all', array('conditions' => array('Applicant.clientcase_id' => $clientcase['Clientcase']['id'], 'NOT' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id']))));
        $appdate = date('d/m/Y', strtotime($clientcase['Clientcase']['appointment_date']));

        //Case status
        $statuses = $this->Casestatus->Status->find('list');
        $casestatuses = $this->Casestatus->find('all', array('conditions' => array('Casestatus.clientcase_id' => $clientcase['Clientcase']['id']), 'order' => array('Casestatus.date_updated DESC')));

        //Documents
        $documentTypes = $this->Documenttype->find('list', array('fields' => array('Documenttype.id', 'Documenttype.type'), 'order'=>'type ASC'));
        $ancestorTypes = $this->Ancestortype->find('list', array('fields' => array('Ancestortype.id', 'Ancestortype.ancestor_type'), 'order'=>'ancestor_type ASC'));

        $ancestordocuments = $this->Document->find('all', array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL, 'Document.copy_type' => 'Digital'), 'order' => 'Document.id DESC'));
        $applicantdocuments = $this->Document->find('all', array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL, 'Document.copy_type' => 'Digital'), 'order'=> array('Document.applicant_id ASC', 'Document.id DESC')));
        $physicalancdocuments = $this->Document->find('all',array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.applicant_id' => NULL, 'NOT' => array('Document.copy_type' => 'Digital')), 'order'=>'Document.id DESC'));
        $physicalappdocuments = $this->Document->find('all', array('conditions' => array('Document.archive_id' => $clientcase['Clientcase']['archive_id'], 'Document.ancestortype_id' => NULL, 'NOT' => array('Document.copy_type' => 'Digital')), 'order'=> array('Document.applicant_id ASC', 'Document.id DESC')));

        $this->set(compact( 'id', 'clientcase', 'user', 'employee','currentloan', 'applicantslist', 'archivecount', 'mainapplicant','address', 'applicants','appdate', 'statuses', 'casestatuses', 'documentTypes', 'ancestorTypes',  'ancestordocuments', 'applicantdocuments', 'physicalancdocuments', 'physicalappdocuments'));
    }
    /**
     * denied page
     *
     * A page similar to the case page, but used to display denied cases.
     * The information presented on this page is greatly limited compared to the information available on the case page.
     */
    public function denied($id = null) {
        $this->loadModel('Applicant');
        $clientcase = $this->Clientcase->find('first', array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id)));
        $mainapplicant = $this->Applicant->find('first', array('conditions' => array('Applicant.id' => $clientcase['Clientcase']['applicant_id'])));
        $this->set(compact('clientcase', 'id', 'mainapplicant'));
    }


    
    public function editAppointmentDate() {
        if ($this->request->is('post')|| $this->request->is('put')) {
            $this->request->data['Clientcase']['appointment_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['appointmentDate'])));
            if ($this->Clientcase->save($this->request->data, false)) {
                $this->Session->setFlash(__('The Appointment Date has been edited', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));
            } else {
                $this->Session->setFlash(__('The Appointment Date could not be edited. Please, try again.', null),'default', array('class' => 'alert-danger'));

            }
        }
    }
    
    public function updateAppointmentDate() {
        if ($this->request->is('post')|| $this->request->is('put')) {
            $this->request->data['Clientcase']['appointment_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['appointmentDate'])));
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
    
    public function updateOpenClose() {
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
     * edit method
     *
     * Allows staff to alter the information supplied by the client in the eligibility check.
     */
    public function edit($id = null) {
    	$this->request->data['Clientcase']['id']=$id;
        if (!$this->Clientcase->exists($id)) {
            throw new NotFoundException(__('Invalid Client Case'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Clientcase->save($this->request->data)) {
                $this->Session->setFlash(__('The client case has been saved', null),'default', array('class' => 'alert-success'));
                return $this->redirect(array('controller' => 'clientcases', 'action' => 'view', $this->request->data['Clientcase']['id']));
            } else {
                $this->Session->setFlash(__('The client case could not be saved. Please, try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
            $options = array('conditions' => array('Clientcase.' . $this->Clientcase->primaryKey => $id));
            $this->request->data = $this->Clientcase->find('first', $options);
    }

    /**
     * merge method
     *
     * The page from which a staff member can initiate an archive merge.
     */

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

    /**
     * merge method
     *
     * The logic for performing an archive merge.
     */

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
			//Deleting the loan records for this archive, if any.
			if(!empty($archiveloans))
			{
				foreach ($archiveloans as $archiveloan):
				$this->Archiveloan->id = $archiveloan['Archiveloan']['id'];
				$this->Archiveloan->delete();
				endforeach;
			}
            
			// Setting the case's archive id to the new archive id
            $this->request->data['Clientcase']['id'] = $current_client_id;
            $this->request->data['Clientcase']['archive_id'] = $merging_archive_id;
            $this->Clientcase->save($this->request->data);

            //Copy/move docs to older archive, delete folder etc.
            $documents = $this->Document->find('all', array('conditions' => array('Document.archive_id' => $current_archive_id)));
			
			if(!empty($documents))
			{		
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
        }
        else
        {
            $this->Session->setFlash(__('You cannot merge an archive with itself.'),'default', array('class' => 'alert-danger'));
            return $this->redirect(array('action' => 'view', $current_client_id));
        }

    }

    /**
     * reporting method
     *
     * The reporting page allows staff to nominate two dates and a category, and view all entries between those dates that relate to that category.
     */

    public function reporting()
    {
        $this->loadModel('Casenote');
        $this->loadModel('Clientcase');
        $this->loadModel('Document');
        $this->loadModel('Docnote');

        if(empty($selected))
        {
            $selected = 0;
        }

        if ($this->request->is('post')) {
            $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
            $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

            $selected = $this->request->data['Clientcase']['selection'];

            if($selected == 1)
            {
               /*$clientcases = $this->Clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                ORDER BY Clientcase.id DESC");*/
                    $clientcases = $this->Clientcase->find('all', array('conditions' => array('Clientcase.open_or_closed' => 'Open', 'DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2, 'NOT' => array('Clientcase.status_id' => 0))));
            }
            else if($selected == 2)
            {
                /*$deniedcases = $this->clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive
                WHERE Casenote.clientcase_id = Clientcase.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.status_id = 0
                ORDER BY Casenote.id DESC");
                    */
                $deniedcases = $this->Clientcase->find('all', array('conditions' => array('DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2, 'Clientcase.status_id' => 0)));
            }
            else if($selected == 3)
            {
                $casenotes = $this->Casenote->query("SELECT distinct Casenote.clientcase_id, Casenote.subject, Casenote.created, Archive.archive_name, Applicant.first_name, Applicant.surname, Employee.first_name, Employee.surname
                FROM casenotes AS Casenote, clientcases AS Clientcase, archives AS Archive, applicants AS Applicant, employees AS Employee
                WHERE Casenote.clientcase_id = Clientcase.id AND Archive.id = Clientcase.archive_id AND Applicant.id = Clientcase.applicant_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Casenote.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Casenote.created, '%Y%m%d') <= ".$date2."
                AND (Casenote.user_id = Employee.user_id OR Casenote.user_id = Clientcase.user_id)
                group by Casenote.id");

            }
            else if($selected == 4)
            {
                $documents = $this->Document->query("SELECT distinct Documenttype.type, Document.id, Document.applicant_id, Document.ancestortype_id, Document.filename, Document.copy_type, Document.applicant_id, Document.ancestortype_id,Document.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM documents AS Document, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, documenttypes AS Documenttype
                WHERE Document.archive_id = Archive.id AND Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Document.documenttype_id = Documenttype.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Document.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Document.created, '%Y%m%d') <= ".$date2."
                ORDER BY Document.id DESC");
            }
            else if($selected == 5)
            {
                $docnotes = $this->Docnote->query("SELECT distinct Docnote.id,  Docnote.note, Docnote.document_id, Docnote.employee_id, Docnote.created, Clientcase.id, Applicant.first_name, Applicant.surname, Archive.archive_name, Employee.first_name, Employee.surname
                FROM docnotes AS Docnote, clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, employees AS Employee
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Docnote.created, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Docnote.created, '%Y%m%d') <= ".$date2."
                AND (Docnote.employee_id = Employee.id OR Docnote.clientcase_id = Clientcase.id)
				group by Docnote.id;");
            }
            else if($selected == 6)
            {
                $changedcases = $this->Clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Status.status_type, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, statuses AS Status, casestatuses AS Casestatus
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.status_id = Status.id AND Casestatus.clientcase_id = Clientcase.id AND Casestatus.status_id = Status.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') <= ".$date2."
                GROUP BY Clientcase.id;");
            }
            else if($selected == 7)
            {
                $nocasenotes = $this->Casenote->query("SELECT distinct Casenote.clientcase_id, Casenote.created, Clientcase.created, Clientcase.id, Archive.archive_name, Applicant.first_name, Applicant.surname, Employee.first_name, Employee.surname
                FROM casenotes AS Casenote, clientcases AS Clientcase, archives AS Archive, applicants AS Applicant, employees AS Employee
                WHERE Casenote.clientcase_id = Clientcase.id AND Archive.id = Clientcase.archive_id AND Applicant.id = Clientcase.applicant_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND (DATE_FORMAT(Casenote.created, '%Y%m%d') NOT BETWEEN ".$date1." AND ".$date2.")
                AND (Casenote.user_id = Employee.user_id OR Casenote.user_id = Clientcase.user_id)
                group by Clientcase.id");
            }
            else if($selected == 8)
            {
                $nochangedcases = $this->Clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Status.status_type, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, statuses AS Status, casestatuses AS Casestatus
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.status_id = Status.id AND Casestatus.clientcase_id = Clientcase.id AND Casestatus.status_id = Status.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND (DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') NOT BETWEEN ".$date1." AND ".$date2.")
                GROUP BY Clientcase.id;");
            }
        }
        $this->set(compact('date1', 'date2', 'selected', 'clientcases', 'deniedcases', 'casenotes', 'documents', 'docnotes', 'changedcases', 'nocasenotes', 'nochangedcases'));
    }

    /**
     * report functions
     *
     * Used to generate excel reports.
     */

    public function report()
    {
        $this->loadModel('Clientcase');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

        $data = $this->Clientcase->find('all', array('conditions' => array('Clientcase.open_or_closed' => 'Open', 'DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2, 'NOT' => array('Clientcase.status_id' => 0))));
        $this->set(compact('data'));
    }
    public function report2()
    {
        $this->loadModel('Clientcase');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

        $data = $this->Clientcase->find('all', array('conditions' => array('DATE_FORMAT(Clientcase.created, "%Y%m%d") >= '.$date1, 'DATE_FORMAT(Clientcase.created, "%Y%m%d") <= '.$date2, 'Clientcase.status_id' => 0)));
        $this->set(compact('data'));
    }
    public function report3()
    {
        $this->loadModel('Clientcase');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

        $data = $this->Clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Status.status_type, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, statuses AS Status, casestatuses AS Casestatus
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.status_id = Status.id AND Casestatus.clientcase_id = Clientcase.id AND Casestatus.status_id = Status.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') >= ".$date1." AND DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') <= ".$date2."
                GROUP BY Clientcase.id;");
        $this->set(compact('data'));
    }
    public function report4()
    {
        $this->loadModel('Clientcase');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

        $data = $this->Clientcase->query("SELECT distinct Casenote.clientcase_id, Casenote.created, Clientcase.created, CLientcase.id, Archive.archive_name, Applicant.first_name, Applicant.surname, Employee.first_name, Employee.surname
                FROM casenotes AS Casenote, clientcases AS Clientcase, archives AS Archive, applicants AS Applicant, employees AS Employee
                WHERE Casenote.clientcase_id = Clientcase.id AND Archive.id = Clientcase.archive_id AND Applicant.id = Clientcase.applicant_id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND (DATE_FORMAT(Casenote.created, '%Y%m%d') NOT BETWEEN ".$date1." AND ".$date2.")
                AND (Casenote.user_id = Employee.user_id OR Casenote.user_id = Clientcase.user_id)
                group by Clientcase.id");
        $this->set(compact('data'));
    }
    public function report5()
    {
        $this->loadModel('Clientcase');
        $date1 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date1'])));
        $date2 = date('Ymd', strtotime(str_replace('/', '-', $this->request->data['Clientcase']['date2'])));

        $data = $this->Clientcase->query("SELECT distinct Clientcase.id, Clientcase.created, Status.status_type, Applicant.first_name, Applicant.surname, Archive.archive_name
                FROM clientcases AS Clientcase, applicants AS Applicant, archives AS Archive, statuses AS Status, casestatuses AS Casestatus
                WHERE Applicant.id = Clientcase.applicant_id AND Archive.id = Clientcase.archive_id AND Clientcase.status_id = Status.id AND Casestatus.clientcase_id = Clientcase.id AND Casestatus.status_id = Status.id
                AND Clientcase.open_or_closed = 'Open' AND Clientcase.status_id <> 0
                AND (DATE_FORMAT(Casestatus.date_updated, '%Y%m%d') NOT BETWEEN ".$date1." AND ".$date2.")
                GROUP BY Clientcase.id;");
        $this->set(compact('data'));
    }
}
