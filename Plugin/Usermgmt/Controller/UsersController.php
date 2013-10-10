<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');

App::uses('UserMgmtAppController', 'Usermgmt.Controller');


class UsersController extends UserMgmtAppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.LoginToken');
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth=$this->UserAuth;
        $this->loadModel('Usermgmt.Employee');
        //$this->Auth->allow('newclient'); // Letting users register themselves
	}
	/**
	 * Used to display all users by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function allemployees() {
		/*$this->User->unbindModel( array('hasMany' => array('LoginToken')));
		$users=$this->User->find('all', array('order'=>'User.id desc'));
		$this->set('users', $users);
		*/
       // $this->User->recursive = 0;
        //$this->set('users', $this->Paginator->paginate());
        //$this->set('users', $this->Employee->find('all', array('recursive' => -1)));
        $this->set('users', $this->User->find('all', array('conditions' => array('User.type' => 'Employee'), 'recursive' => 2)));
    }
	/**
	 * Used to display detail of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return array
	 */
	public function viewUser($userId=null) {
		if (!empty($userId)) {
            $this->loadModel('Employee');
			$user = $this->User->read(null, $userId);
            $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userId)));
			$this->set('user', $user);
            $this->set('employee', $employee);
            $this->set('userId', $userId);
		} else {
			$this->redirect('/allemployees');
		}
	}
	/**
	 * Used to display detail of user by user
	 *
	 * @access public
	 * @return array
	 */
	public function myprofile() {
		$userId = $this->UserAuth->getUserId();
		$user = $this->User->read(null, $userId);
		$this->set('user', $user);
	}
	/**
	 * Used to logged in the site
	 *
	 * @access public
	 * @return void
	 */
	public function login() {
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if($this->User->LoginValidate()) {
				$username  = $this->data['User']['username'];
				$password = $this->data['User']['password'];

				$user = $this->User->findByUsername($username);

                if (empty($user)) {
                    $this->Session->setFlash(__('Incorrect Email or Password', null),'default', array('class' => 'alert-danger'));
                    return;
				}
				// check for inactive account
				if ($user['User']['id'] != 1 and $user['User']['active']==0) {
					$this->Session->setFlash(__('Sorry your account is not active, please contact the Administrator', null),'default', array('class' => 'alert-danger'));
                    return;
				}
				if(empty($user['User']['salt'])) {
					$hashed = md5($password);
				} else {
					$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);
				}
				if ($user['User']['password'] === $hashed) {
					if(empty($user['User']['salt'])) {
						$salt=$this->UserAuth->makeSalt();
						$user['User']['salt']=$salt;
						$user['User']['password']=$this->UserAuth->makePassword($password, $salt);
						$this->User->save($user,false);
					}
					$this->UserAuth->login($user);
					$remember = (!empty($this->data['User']['remember']));
					if ($remember) {
						$this->UserAuth->persist('2 weeks');
					}
					$OriginAfterLogin=$this->Session->read('Usermgmt.OriginAfterLogin');
					$this->Session->delete('Usermgmt.OriginAfterLogin');
					//$redirect = (!empty($OriginAfterLogin)) ? $OriginAfterLogin : LOGIN_REDIRECT_URL;
					//$this->redirect($redirect);
                    $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'display', 'home'));

                } else {
					$this->Session->setFlash(__('Incorrect Email/Username or Password', null),'default', array('class' => 'alert-danger'));
                    return;
				}
			}
		}
	}
	/**
	 * Used to logged out from the site
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {
		$this->UserAuth->logout();
		$this->Session->setFlash(__('You have signed out', null),'default', array('class' => 'alert-success'));
        $this->redirect(LOGOUT_REDIRECT_URL);
	}
	/**
	 * Used to register on the site
	 *
	 * @access public
	 * @return void
	 */

    public function register() {
        $this->loadModel('Archive');
        $this->loadModel('Applicant');
        $this->loadModel('ClientCase');
        $this->loadModel('Casestatus');

        if ($this->request -> isPost()) {
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
            $this->request->data['User']['active']=1;

            $salt=$this->UserAuth->makeSalt();
            $this->request->data['User']['salt'] = $salt;
            $password = $this->generatePassword();
            $this->request->data['User']['password'] = $this->UserAuth->makePassword($password, $salt);
            $this->request->data['User']['user_group_id']=2;
            $this->request->data['User']['type']='Client';

            $eligible = true;
            if(empty($this->request->data['ClientCase']['nationality_of_parents'])
                && empty($this->request->data['ClientCase']['nationality_of_grandparents'])
                && $this->request->data['ClientCase']['born_in_poland'] != 'Yes'
                && $this->request->data['ClientCase']['have_passport'] != 'Yes'
            )
            {$eligible = false;}

            if($eligible)
            {
                $this->createArchive(); //Leads to the function that creates the Archive entry.
                $this->User->create();
                if ($this->User->save($this->request->data, false)) {
                    $this->request->data['ClientCase']['user_id'] = $this->User->getLastInsertId();
                    $this->ClientCase->create();
                    $this->ClientCase->save($this->request->data);

                    $this->request->data['Applicant']['clientcase_id'] = $this->ClientCase->getLastInsertId();
                    $this->Applicant->create();
                    $this->Applicant->save($this->request->data);

                    $this->request->data['ClientCase']['applicant_id'] = $this->Applicant->getLastInsertId();
                    $this->request->data['ClientCase']['id'] = $this->ClientCase->getLastInsertId();
                    $this->ClientCase->save($this->request->data);

                    $this->request->data['Casestatus']['clientcase_id'] = $this->ClientCase->getLastInsertId();
                    $this->request->data['Casestatus']['status_id'] = 1;
                    $this->Casestatus->save($this->request->data);

                    $this->acceptEmail($this->request->data['Applicant']['email'], $password);
                    $this->Session->setFlash(__('Thank You! <br /><strong>Your QuickCheck Eligibility Report has been emailed to your nominated email address.
                Congratulations on taking the first step towards your Polish citizenship. We look forward to assisting you with your journey to a Polish
                passport and can be conducted any time if you have any questions. <br />Your report should be sent in the next 5 minutes. If you do not
                receive it, please verify your email, check your Junk folder or email us at polish@polaron.com.au.</strong>', null),
                        'default', array('class' => 'alert-success'));
                    $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'login'));
                }else {
                    $this->Session->setFlash(__('The user could not be saved', null),'default', array('class' => 'alert-danger'));
                }
            }else {
                $this->Session->setFlash(__('The user could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
            }
        }
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


    public function acceptEmail($email_addr, $password) {
        $Email = new CakeEmail();
        $Email->config('default');

        $Email->sender(array('polarontest@gmail.com' => 'Polaron'));
        $Email->from(array('polarontest@gmail.com' => 'Polaron'));
        $Email->to($email_addr);
        $Email->subject('Eligibility Check');
        $Email->template('welcome');
        $Email->emailFormat('text');
        $Email->viewVars(array('name' => $this->request->data['Applicant']['first_name'], 'email' => $this->request->data['Applicant']['email'], 'password' => $password));
        $Email->attachments(array(
            'Polaron - PL Passport - Info Pack - 2013.pdf' => array(
                'file' => APP.'documents/Email_attachments/Polaron - PL Passport - Info Pack - 2013.pdf',
                'mimetype' => 'pdf'),
        ));


        $Email->send();
    }

    public function rejectEmail($email_addr) {
        $Email = new CakeEmail();
        $Email->config('default');

        $Email->sender(array('polarontest@gmail.com' => 'Polaron'));
        $Email->from(array('polarontest@gmail.com' => 'Polaron'));
        $Email->to($email_addr);
        $Email->subject('Eligibility Check');
        $Email->template('denied');
        $Email->emailFormat('text');
        $Email->viewVars(array('name' => $this->request->data['Applicant']['first_name']));


        $Email->send();

    }

    //public function test() {
    // $this->loadModel('Applicant');
    // if ($this->request->is('post') || $this->request->is('put')) {
    // $email_addr = $this->request->data['Applicant']['email'];

    // $Email = new CakeEmail();
    // $Email->config('default');
    // $Email->template('welcome');
    // $Email->emailFormat('text');
    // $Email->viewVars(array('name' => 'Jessica', 'email' => $this->request->data['Applicant']['email'],'password' => $this->generatePassword()));


    // $Email->sender(array('polarontest@gmail.com' => 'Polaron sender'));
    // $Email->from(array('polarontest@gmail.com' => 'Polaron'));
    // $Email->to($email_addr);
    // $Email->subject('Eligibility Check');
    // $Email->attachments(array(
    // 'Client details form - 2013.pdf' => array(
    // 'file' => APP.'Documents/Email_attachments/Client details form - 2013.pdf',
    // 'mimetype' => 'pdf'),
    // 'Polaron - PL Passport - Info Pack - 2013.pdf' => array(
    // 'file' => APP.'Documents/Email_attachments/Polaron - PL Passport - Info Pack - 2013.pdf',
    // 'mimetype' => 'pdf'),
    // 'Polaron Family Tree - 2013.pdf' => array(
    // 'file' => APP.'Documents/Email_attachments/Polaron Family Tree - 2013.pdf',
    // 'mimetype' => 'pdf'),
    // 'Polaron Processing Stages - 2013.pdf' => array(
    // 'file' => APP.'Documents/Email_attachments/Polaron Processing Stages - 2013.pdf',
    // 'mimetype' => 'pdf'),
    // ));
    // $Email->send();

    // }
    //}


    public function generatePassword(){
        $password = substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) , 0 , 10 );
        return $password;

    }

	/**
	 * Used to change the password by user
	 *
	 * @access public
	 * @return void
	 */
	public function changePassword() {
		$userId = $this->UserAuth->getUserId();
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if ($this->User->RegisterValidate()) {
				$user=array();
				$user['User']['id']=$userId;
				$salt=$this->UserAuth->makeSalt();
				$user['User']['salt'] = $salt;
				$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$this->User->save($user,false);
				$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
				$this->Session->setFlash(__('Password changed successfully', null),'default', array('class' => 'alert-success'));
                if($this->UserAuth->getUserType() == 'Employee')
                {
                    return $this->redirect(array('plugin' => false,'controller' => 'employees','action' => 'myaccount'));
                }
                else
                {
                    return $this->redirect(array('plugin' => false,'controller' => 'clientcases','action' => 'myaccount'));
                }
			}
		}
	}

	/**
	 * Used to change the user password by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function changeUserPassword($userId=null) {
		if (!empty($userId)) {
			$this->loadModel('Employee');
            $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userId)));
            $name=$employee['Employee']['first_name'].' '.$employee['Employee']['surname'];
			$this->set('name', $name);
			if ($this->request -> isPost()) {
				$this->User->set($this->data);
				if($this->User->RegisterValidate()) {
					$user=array();
					$user['User']['id']=$userId;
					$salt=$this->UserAuth->makeSalt();
					$user['User']['salt'] = $salt;
					$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->User->save($user,false);
					$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
					$this->Session->setFlash(__('Password for '.$employee['Employee']['first_name'].' '.$employee['Employee']['surname'].' changed successfully', $name, null),'default', array('class' => 'alert-success'));
                    $this->redirect('/allemployees');
				}
			}
		} else {
			$this->redirect('/allemployees');
		}
        $this->set('userId', $userId);
	}
	/**
	 * Used to add user on the site by Admin
	 *
	 * @access public
	 * @return void
	 */
    public function newemployee() {
        $this->loadModel('Employee');
        $userGroups=$this->UserGroup->getGroups();
        $this->set('userGroups', $userGroups);
        if ($this->request -> isPost()) {
            $this->User->set($this->data);
            if ($this->User->RegisterValidate()) {
				$this->request->data['User']['type']='Employee';
                $this->request->data['User']['active']=1;
                $salt=$this->UserAuth->makeSalt();
                $this->request->data['User']['salt'] = $salt;
                $this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
                if($this->User->save($this->request->data, false))
                {
                    $this->request->data['Employee']['user_id'] = $this->User->getLastInsertId();
                    $this->Employee->create();
                    $this->Employee->save($this->request->data);

                    $this->Session->setFlash(__('The employee was successfully added', null),'default', array('class' => 'alert-success', null),'default', array('class' => 'alert-success'));
                }
                else
                {$this->Session->setFlash(__('An error was encountered.', null),'default', array('class' => 'alert-danger'));
                }

                $this->redirect('/allemployees');
            }
        }
    }

    public function newclient() {
        $this->loadModel('Archive');
        $this->loadModel('Applicant');
        $this->loadModel('ClientCase');
        if ($this->request->is('post')) {

            $this->User->set($this->data);
            $this->User->RegisterValidate();
            $this->request->data['User']['active']=1;
            $salt=$this->UserAuth->makeSalt();
            $this->request->data['User']['salt'] = $salt;
            $this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);



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
                    $this->Session->setFlash(__('The user has been saved', null),'default', array('class' => 'alert-success'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
                }else {
                    $this->Session->setFlash(__('The user could not be saved. Please try again.', null),'default', array('class' => 'alert-danger'));
                }
            }
            else
            {
                $this->emailReject($this->request->data['Applicant']['email']);
            }
        }
    }
	/**
	 * Used to edit user on the site by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function editUser($userId=null) {
		if (!empty($userId)) {
            $this->loadModel('Employee');
			$userGroups=$this->UserGroup->getGroups();
			$this->set('userGroups', $userGroups);
			if ($this->request -> isPut()) {
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
                    $emp_id = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userId)));
                    $this->request->data['Employee']['id'] = $emp_id['Employee']['id'];
					$this->User->saveAll($this->request->data);
					$this->Session->setFlash(__('The user was successfully updated', null),'default', array('class' => 'alert-success'));
                    $this->redirect('/allemployees');
				}
			} else {
				$user = $this->User->read(null, $userId);
				$this->request->data=null;
				if (!empty($user)) {
					$user['User']['password']='';
					$this->request->data = $user;
				}
			}
		} else {
			$this->redirect('/allemployees');
		}
        $this->set('userId', $userId);
	}
	/**
	 * Used to delete the user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function deleteUser($userId = null) {
		if (!empty($userId)) {
			if ($this->request -> isPost()) {
				if ($this->User->delete($userId, false)) {
					$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
					$this->Session->setFlash(__('User was successfully deleted', null),'default', array('class' => 'alert-success'));
                }
			}
			$this->redirect('/allemployees');
		} else {
			$this->redirect('/allemployees');
		}
	}
	/**
	 * Used to show dashboard of the user
	 *
	 * @access public
	 * @return array
	 */
	public function dashboard() {
        $this->loadModel('Employee');
		$userId=$this->UserAuth->getUserId();
		$user = $this->User->findById($userId);
        $employee = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => $userId)));
		$this->set('user', $user);
        $this->set('employee', $employee);
	}
	/**
	 * Used to activate or deactivate user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @param integer $active active or inactive
	 * @return void
	 */
	public function makeActiveInactive($userId = null, $active=0) {
		if (!empty($userId)) {
			$user=array();
			$user['User']['id']=$userId;
			$user['User']['active']=($active) ? 1 : 0;
			$this->User->save($user,false);
			if($active) {
				$this->Session->setFlash(__('User was successfully activated', null),'default', array('class' => 'alert-success'));
            } else {
				$this->Session->setFlash(__('User was successfully deactivated', null),'default', array('class' => 'alert-success'));
            }
		}
		$this->redirect('/allemployees');
	}
	/**
	 * Used to verify email of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function verifyEmail($userId = null) {
		if (!empty($userId)) {
			$user=array();
			$user['User']['id']=$userId;
			$user['User']['email_verified']=1;
			$this->User->save($user,false);
			$this->Session->setFlash(__('User email was successfully verified', null),'default', array('class' => 'alert-success'));
        }
		$this->redirect('/allemployees');
	}
	/**
	 * Used to show access denied page if user want to view the page without permission
	 *
	 * @access public
	 * @return void
	 */
	public function accessDenied() {

	}
	/**
	 * Used to verify user's email address
	 *
	 * @access public
	 * @return void
	 */
	/*public function userVerification() {
		if (isset($_GET['ident']) && isset($_GET['activate'])) {
			$userId= $_GET['ident'];
			$activateKey= $_GET['activate'];
			$user = $this->User->read(null, $userId);
			if (!empty($user)) {
				if (!$user['User']['email_verified']) {
					$password = $user['User']['password'];
					$theKey = $this->User->getActivationKey($password);
					if ($activateKey==$theKey) {
						$user['User']['email_verified']=1;
						$this->User->save($user,false);
						if (SEND_REGISTRATION_MAIL && EMAIL_VERIFICATION) {
							$this->User->sendRegistrationMail($user);
						}
						$this->Session->setFlash(__('Thank you, your account is activate now'));
					}
				} else {
					$this->Session->setFlash(__('Thank you, your account was already activated'));
				}
			} else {
				$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
			}
		} else {
			$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
		}
		$this->redirect('/login');
	}
	*/
	/**
	 * Used to send forgot password email to user
	 *
	 * @access public
	 * @return void
	 */
	public function forgotPassword() {
		if ($this->request -> isPost()) {
            $this->loadModel('Employee');
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->request->data['User']['username'];
				$user = $this->User->findByUsername($email);
				/*if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'));
						return;
					}
				}
				*/
				// check for inactive account
				$this->User->forgotPassword($user);
				$this->Session->setFlash(__('Please check your mail to reset your password', null),'default', array('class' => 'alert-success'));
                //$this->redirect('/login');
			}
		}
	}
	/**
	 *  Used to reset password when user comes on the by clicking the password reset link from their email.
	 *
	 * @access public
	 * @return void
	 */
	public function activatePassword() {
		if ($this->request -> isPost()) {
			if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate'])) {
				$this->set('ident',$this->data['User']['ident']);
				$this->set('activate',$this->data['User']['activate']);
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$userId= $this->data['User']['ident'];
					$activateKey= $this->data['User']['activate'];
					$user = $this->User->read(null, $userId);
					if (!empty($user)) {
						$password = $user['User']['password'];
						$thekey =$this->User->getActivationKey($password);
						if ($thekey==$activateKey) {
							$user['User']['password']=$this->data['User']['password'];
							$salt=$this->UserAuth->makeSalt();
							$user['User']['salt'] = $salt;
							$user['User']['password'] = $this->UserAuth->makePassword($user['User']['password'], $salt);
							$this->User->save($user,false);
							$this->Session->setFlash(__('Your password has been reset successfully', null),'default', array('class' => 'alert-success'));
                            $this->redirect('/login');
						} else {
							$this->Session->setFlash(__('Something went wrong, please send password reset link again', null),'default', array('class' => 'alert-danger'));
                        }
					} else {
						$this->Session->setFlash(__('Something went wrong, please click again on the link in email', null),'default', array('class' => 'alert-danger'));
                    }
				}
			} else {
				$this->Session->setFlash(__('Something went wrong, please click again on the link in email', null),'default', array('class' => 'alert-danger'));
            }
		} else {
			if (isset($_GET['ident']) && isset($_GET['activate'])) {
				$this->set('ident',$_GET['ident']);
				$this->set('activate',$_GET['activate']);
			}
		}
	}
	/**
	 * Used to send email verification mail to user
	 *
	 * @access public
	 * @return void
	 */
	/*public function emailVerification() {
		if ($this->request -> isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username', null),'default', array('class' => 'alert-danger'));
                        return;
					}
				}
				if($user['User']['email_verified']==0) {
					$this->User->sendVerificationMail($user);
					$this->Session->setFlash(__('Please check your mail to verify your email'));
				} else {
					$this->Session->setFlash(__('Your email is already verified'));
				}
				$this->redirect('/login');
			}
		}
	}
	*/
}
