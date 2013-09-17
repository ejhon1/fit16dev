<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');

//App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('newclient','newemployee'); // Letting users register themselves
    }

    /*public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }
    */

    /*Old logout function (replaced by usermgmt plugin)
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    */

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
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function newclient() {
        $this->loadModel('Archive');
        $this->loadModel('Applicant');
        $this->loadModel('ClientCase');
        if ($this->request->is('post')) {
            $this->createArchive(); //Leads to the function that creates the Archive entry.
            $this->request->data['ClientCase']['nationality_of_parents']= implode(',', $this->request->data['ClientCase']['nationality_of_parents']);
            $this->request->data['ClientCase']['nationality_of_grandparents']= implode(',', $this->request->data['ClientCase']['nationality_of_grandparents']);
            $this->request->data['ClientCase']['when_left_poland']= implode(',', $this->request->data['ClientCase']['when_left_poland']);
            $this->request->data['ClientCase']['where_left_poland']= implode(',', $this->request->data['ClientCase']['where_left_poland']);
            $this->request->data['ClientCase']['possess_documents_types']= implode(',', $this->request->data['ClientCase']['possess_documents_types']);
            $this->request->data['ClientCase']['other_factors']= implode(',', $this->request->data['ClientCase']['other_factors']);
            $this->request->data['ClientCase']['open_or_closed'] = 'Open';
            $this->request->data['ClientCase']['status_id'] = 1;
            $this->request->data['User']['username'] = $this->request->data['Applicant']['email'];
            //$this->request->data['Applicant']['birthdate'] = CakeTime::dayAsSql($this->request->data['Applicant']['birthdate'], 'modified');

            $eligible = true;
            if(empty($this->request->data['ClientCase']['nationality_of_parents'])
                && empty($this->request->data['ClientCase']['nationality_of_grandparents'])
                && $this->request->data['ClientCase']['born_in_poland'] != 'Yes'
                && $this->request->data['ClientCase']['have_passport'] != 'Yes'
            )
            {$eligible = false;}

            if(!($eligible))
            {
                $this->User->create();
                if ($this->User->saveAll($this->request->data, array('deep' => true))) {
                    $this->request->data['ClientCase']['user_id'] = $this->User->getLastInsertId();
                    $this->ClientCase->create();
                    $this->ClientCase->save($this->request->data);

                    $this->request->data['Applicant']['clientcase_id'] = $this->ClientCase->getLastInsertId();
                    $this->Applicant->create();
                    $this->Applicant->save($this->request->data);

                    $this->request->data['ClientCase']['applicant_id'] = $this->Applicant->getLastInsertId();
                    $this->request->data['ClientCase']['id'] = $this->ClientCase->getLastInsertId();
                    $this->ClientCase->save($this->request->data);
                    $this->emailAccept($this->request->data['Applicant']['email']);
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
                }else {
                    $this->Session->setFlash(__('The user could not be saved. Please try again.'));
                }
            }
            else
            {
                $this->emailReject($this->request->data['Applicant']['email']);
            }
        }
    }

    public function logictest() {
        $this->loadModel('Applicant');
        $this->loadModel('ClientCase');
        if ($this->request->is('post')) {
            $this->request->data['ClientCase']['nationality_of_parents']= implode(',', $this->request->data['ClientCase']['nationality_of_parents']);
            $this->request->data['ClientCase']['nationality_of_grandparents']= implode(',', $this->request->data['ClientCase']['nationality_of_grandparents']);

            $eligible = true;
            if(empty($this->request->data['ClientCase']['nationality_of_parents'])
            && empty($this->request->data['ClientCase']['nationality_of_grandparents'])
            && $this->request->data['ClientCase']['born_in_poland'] != 'Yes'
            && $this->request->data['ClientCase']['have_passport'] != 'Yes'
            )
            {$eligible = false;}

            //if(strpos($this->request->data['ClientCase']['nationality_of_parents'],'Mother')!== false
            //|| strpos($this->request->data['ClientCase']['nationality_of_parents'],'Father')!== false)
            //{$foreignArmy = true;}
            //if(strpos($this->request->data['ClientCase']['other_factors'],'One of my ancestors held public office outside of Poland')!== false)
            //{$officeOutside = true;}

            if(!($eligible))
            //if(($parents || $officeOutside) && $this->request->data['ClientCase']['born_in_poland'].value == 'No')
            //&& ($this->request->data['ClientCase']['born_in_poland'] != 'Yes'))
            {
                $this->Session->setFlash(__('Rejected: '.$this->request->data['ClientCase']['born_in_poland']));

                //echo $this->request->data['ClientCase']['born_in_poland'];
                //$this->emailReject($this->request->data['Applicant']['email']);
                //Needs to redirect to rejected page?
                //$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            }
            else
            {
                $this->Session->setFlash(__('Accepted: '.$this->request->data['ClientCase']['born_in_poland']));
                //Where should this redirect to?
                //$this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            }
        }
    }

    public function newemployee() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->saveAll($this->request->data, array('deep' => true))) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Role->find('list', array('order'=>'role_name ASC'));
        $this->set(compact('roles'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }


    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function createArchive()
    {
        $available = false;
        $i = 1;
        $name = strtoupper(substr($this->request->data['Applicant']['surname'], 0, 3)).'-';
        $year = substr(idate('Y', $timestamp = time()), -2);
        do
        {
            $archiveName = $name.$i.'/'.$year;
            $conditions = array('Archive.archive_name' => $archiveName);

            if($this->Archive->hasAny($conditions))
            {
                $i++;
            }
            else
            {
                $available = true;
            }
        }while(!$available);

        $this->request->data['Archive']['archive_name'] = $archiveName;
        $this->Archive->create();
        $this->Archive->save($this->request->data);

        $this->request->data['ClientCase']['archive_id'] = $this->Archive->getLastInsertId();
        $this->request->data['Applicant']['archive_id'] = $this->Archive->getLastInsertId();
    }


    public function acceptEmail($email_addr) {
        $Email = new CakeEmail();
        $Email->config('default');

        $Email->sender(array('polarontest@gmail.com' => 'Polaron'));
        $Email->from(array('polarontest@gmail.com' => 'Polaron'));
        $Email->to($email_addr);
        $Email->subject('Insert subject here');


        $Email->send('Insert message here');

    }

    public function rejectEmail($email_addr) {
        $Email = new CakeEmail();
        $Email->config('default');

        $Email->sender(array('polarontest@gmail.com' => 'Polaron'));
        $Email->from(array('polarontest@gmail.com' => 'Polaron'));
        $Email->to($email_addr);
        $Email->subject('Insert subject here');


        $Email->send('Insert message here');

    }

    public function test() {
        $this->loadModel('Applicant');
        if ($this->request->is('post') || $this->request->is('put')) {
            $email_addr = $this->request->data['Applicant']['email'];

            $Email = new CakeEmail();
            $Email->config('default');


            $Email->sender(array('polarontest@gmail.com' => 'Polaron sender'));
            $Email->from(array('polarontest@gmail.com' => 'Polaron'));
            $Email->to($email_addr);
            $Email->subject('Eligibility Check');
            $Email->attachments(array(
                'thumbs_up.jpg' => array(
                    'file' => APP.'Documents/Email_attachments/thumbs_up.jpg',
                    'mimetype' => 'image/jpgs'
                )
            ));
            $Email->send('Insert message here');

        }
    }
}