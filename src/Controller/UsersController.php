<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('registration', 'logout');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $session = $this->request->getSession();
        $current_user_data = $session->read('Auth.User');
        //pr($current_user_data);

        $users = $this->paginate($this->Users, array( 'conditions' => array('role IN'=>array(2,3) , 'parent'=>$current_user_data['id']), 'contain' => array('UserRoles', 'UserDetails') ));

        //$users_roles = $this->find('all', array( 'conditions' => array('id <>'=>1) ));

        //pr($users);exit;

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $userdetail = $this->Users->UserDetails->newEntity();

        $lastuserquery = $this->Users->find('all', [
            'order' => ['Users.id' => 'DESC']
        ]);
        $lastuser = $lastuserquery->first();
        //$lastuser = $this->Users->get(['order'=>['id' => 'DESC']]);
        //pr($lastuser);exit;

        $userRolesTable = TableRegistry::get('UserRoles');
        $userroles = $userRolesTable->find('all', [
            'conditions' => ['UserRoles.status' => 1]/*,
            'contain' => ['Authors', 'Comments'],
            'limit' => 10*/
        ]);
        //pr($userroles);exit;

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('all', [
            'conditions' => ['Countries.status' => 1]
        ]);

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('all', [
            'conditions' => ['States.status' => 1]
        ]);

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('all', [
            'conditions' => ['Cities.status' => 1]
        ]);

        if ($this->request->is('post')) {

            $newuserId = (int) $lastuser->id + 1;

            $requestData = $this->request->getData('userdetail');
            $requestData['user_id'] = $newuserId;
            $userdetail = $this->Users->UserDetails->newEntity();
            $userdetail = $this->Users->UserDetails->patchEntity($userdetail, $requestData);

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'UserRoles',
                    'UserDetails'
                ]
            ]);

            $user->user_detail = $userdetail;
            //pr($user);exit;
            if ($this->Users->save($user)) { //&& $userDetailsTable->save($userdetail)
                $this->Flash->success(__('The user has been saved.'));

                //return $this->redirect(['action' => 'add']);
                return $this->redirect('/users');
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));

            
        }
        $this->set(compact('user'));
        $this->set(compact('userroles'));
        $this->set(compact('countries'));
        $this->set(compact('states'));
        $this->set(compact('cities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails']
        ]);

        $userDetailsTable = TableRegistry::get('UserDetails');
        $userdetail = $userDetailsTable->findByUserId($id)->first();
        //var_dump($userDetailsTable);exit;
        //pr($userdetail);exit;

        $userRolesTable = TableRegistry::get('UserRoles');
        $userroles = $userRolesTable->find('all', [
            'conditions' => ['UserRoles.status' => 1]/*,
            'contain' => ['Authors', 'Comments'],
            'limit' => 10*/
        ]);
        //pr($userroles);exit;

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('all', [
            'conditions' => ['Countries.status' => 1]
        ]);

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('all', [
            'conditions' => ['States.status' => 1]
        ]);

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('all', [
            'conditions' => ['Cities.status' => 1]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if(isset($userdetail) && !empty($userdetail)){
                $userdetail = $this->Users->UserDetails->patchEntity($userdetail, $this->request->getData('user_detail'));
            } else {
                $userdetail = $this->Users->UserDetails->newEntity();
                $userdetail = $this->Users->UserDetails->patchEntity($userdetail, $this->request->getData('user_detail'));
            }

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'UserRoles',
                    'UserDetails'
                ]
            ]);

            $user->userdetail = $userdetail;
            
            if ($this->Users->save($user)) { //&& $userDetailsTable->save($userdetail)
                $this->Flash->success(__('The user has been saved.'));

                //return $this->redirect(['action' => 'edit', $id]);
                return $this->redirect('/users');
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            
            //pr($this->request->getData());exit;
            /*$user = $this->Users->patchEntity($user, $this->request->getData());

            if(isset($userdetail) && !empty($userdetail)){
                $userdetail = $userDetailsTable->patchEntity($userdetail, $this->request->getData());
            } else {
                $userdetail = $userDetailsTable->newEntity();
                //pr($userdetail);
                //pr($this->request->getData());
                //exit;
                $userdetail = $userDetailsTable->patchEntity($userdetail, $this->request->getData());
            }*/

            /*if ($this->Users->save($user) && $userDetailsTable->save($userdetail)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));*/
        }
        $this->set(compact('user'));
        //$this->set(compact('userdetail'));
        $this->set(compact('userroles'));
        $this->set(compact('countries'));
        $this->set(compact('states'));
        $this->set(compact('cities'));
    }

    public function profile()
    {
        $session = $this->request->getSession();
        $current_user_data = $session->read('Auth.User');
        $id = $current_user_data['id'];
        $role = $current_user_data['role'];
        //var_dump($current_user_data);exit;
        $user = $this->Users->get($id, [
            'contain' => ['UserDetails']
        ]);

        $userDetailsTable = TableRegistry::get('UserDetails');
        $userdetail = $userDetailsTable->findByUserId($id)->first();
        //var_dump($userDetailsTable);exit;
        //pr($userdetail);exit;

        if($role == 1){
            $userRolesTable = TableRegistry::get('UserRoles');
            $userroles = $userRolesTable->find('all', [
                'conditions' => ['UserRoles.status' => 0]/*,
                'contain' => ['Authors', 'Comments'],
                'limit' => 10*/
            ]);
        } else {
            $userRolesTable = TableRegistry::get('UserRoles');
            $userroles = $userRolesTable->find('all', [
                'conditions' => ['UserRoles.status' => 1]/*,
                'contain' => ['Authors', 'Comments'],
                'limit' => 10*/
            ]);
        }
        //pr($userroles);exit;

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('all', [
            'conditions' => ['Countries.status' => 1]
        ]);

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('all', [
            'conditions' => ['States.status' => 1]
        ]);

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('all', [
            'conditions' => ['Cities.status' => 1]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if(isset($userdetail) && !empty($userdetail)){
                $userdetail = $this->Users->UserDetails->patchEntity($userdetail, $this->request->getData('user_detail'));
            } else {
                $userdetail = $this->Users->UserDetails->newEntity();
                $userdetail = $this->Users->UserDetails->patchEntity($userdetail, $this->request->getData('user_detail'));
            }

            if($role == 1){
                $user = $this->Users->patchEntity($user, $this->request->getData(), [
                    'validate'=>'superadmin',
                    'associated' => [
                        'UserRoles',
                        'UserDetails'
                    ]
                ]);
            } else {
                $user = $this->Users->patchEntity($user, $this->request->getData(), [
                    'associated' => [
                        'UserRoles',
                        'UserDetails'
                    ]
                ]);
            }

            $user->user_detail = $userdetail;
            //pr($user);exit;
            if ($this->Users->save($user)) { //&& $userDetailsTable->save($userdetail)
                $this->Flash->success(__('The user has been saved.'));

                //return $this->redirect(['action' => 'edit', $id]);
                return $this->redirect('/users');
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            
            //pr($this->request->getData());exit;
            /*$user = $this->Users->patchEntity($user, $this->request->getData());

            if(isset($userdetail) && !empty($userdetail)){
                $userdetail = $userDetailsTable->patchEntity($userdetail, $this->request->getData());
            } else {
                $userdetail = $userDetailsTable->newEntity();
                //pr($userdetail);
                //pr($this->request->getData());
                //exit;
                $userdetail = $userDetailsTable->patchEntity($userdetail, $this->request->getData());
            }*/

            /*if ($this->Users->save($user) && $userDetailsTable->save($userdetail)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));*/
        }
        $this->set(compact('user'));
        //$this->set(compact('userdetail'));
        $this->set(compact('userroles'));
        $this->set(compact('countries'));
        $this->set(compact('states'));
        $this->set(compact('cities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
