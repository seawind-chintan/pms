<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * UserServices Controller
 *
 * @property \App\Model\Table\UserServicesTable $UserServices
 *
 * @method \App\Model\Entity\UserService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserServicesController extends AppController {

    public function assignServices() {

        $userService = $this->UserServices->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['services'] = implode(',', array_filter($this->request->data['services']));
            $this->request->data['status'] = 1;

//            pr($this->request);
//            exit;

            $userService = $this->UserServices->patchEntity($userService, $this->request->data);
            if(isset($this->request->data['id']) && $this->request->data['id']!=''){$userService->id = $this->request->data['id'];}

//            $result = $this->UserServices->save($userService);
//            echo $record_id=$result->id;

            if ($this->UserServices->save($userService)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Service'));
                return $this->redirect(['action' => 'assignServices']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Service'));
            }
        }

        $users = $this->UserServices->Users->find('list', [ 'keyField' => 'id',
            'valueField' => 'username',
            'conditions' => array('status' => 1, 'parent' => $this->Auth->user('id')),
            'order' => 'id desc'
        ]);
        //pr($users->toArray());exit;

        $this->set(compact('userService', 'users'));
//        $this->set(compact('users'));
        $this->set('_serialize', ['userService']);
    }

    public function showservice($id = null)
    {
//        echo 'id '.$id;
//        exit;

        if($this->request->is('ajax'))
        {

            $this->viewBuilder()->setLayout('ajax');

            $userServicesTable = TableRegistry::get('UserServices');
            $userService_data = $userServicesTable->find('all', array(
                'conditions' => array('user_id' => $id)
            ));
            $userService = $userService_data->first();

            $servicesTable = TableRegistry::get('Services');
            $services = $servicesTable->find('all', array(
                'fields' => array('id', 'name', 'parent_id'),
                'conditions' => array('Services.status' => 1), 'order' => 'id asc'
            ));

//            pr($services->toArray());
//            pr($userService->toArray());
//            exit;

            $service_arr = $parent_arr = array();

            if (!empty($services)) {
                foreach ($services as $services_key => $services_value) {

                    if (empty($services_value->parent_id)) {

                        $services_arr[$services_value->id]['id'] = $services_value['id'];
                        $services_arr[$services_value->id]['name'] = $services_value['name'];
                        //$services_arr[$services_value->id]['parent_id'] = $services_value['parent_id'];
                        $services_arr[$services_value->id]['child'] = array();
                    } else {
                        $services_arr[$services_value->parent_id]['child'][$services_value->id]['id'] = $services_value['id'];
                        $services_arr[$services_value->parent_id]['child'][$services_value->id]['name'] = $services_value['name'];
    //                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['parent_id'] = $services_value['parent_id'];
                    }
                }
            }

            $this->set(compact('userService','services_arr'));
        }
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $this->paginate = [
            'contain' => ['Users']
        ];
        $userServices = $this->paginate($this->UserServices);

//        pr($userServices->toArray());
//        pr($userServices);

        $this->set(compact('userServices'));
    }

    /**
     * View method
     *
     * @param string|null $id User Service id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $userService = $this->UserServices->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('userService', $userService);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $userService = $this->UserServices->newEntity();
        if ($this->request->is('post')) {


            $this->request->data['services'] = implode(',', array_filter($this->request->data['services']));
//            pr($this->request);
//            exit;
            $userService = $this->UserServices->patchEntity($userService, $this->request->data);
            if ($this->UserServices->save($userService)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Service'));
            }
        }

        $users = $this->UserServices->Users->find('list', [ 'keyField' => 'id',
            'valueField' => 'username',
            'conditions' => array('status' => 1),
            'order' => 'id desc'
        ]);

        $servicesTable = TableRegistry::get('Services');
        $services = $servicesTable->find('all', array(
            'fields' => array('id', 'name', 'parent_id'),
            'conditions' => array('Services.status' => 1), 'order' => 'id asc'
        ));

        $service_arr = $parent_arr = array();

        if (!empty($services)) {
            foreach ($services as $services_key => $services_value) {

                if (empty($services_value->parent_id)) {

                    $services_arr[$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->id]['name'] = $services_value['name'];
                    //$services_arr[$services_value->id]['parent_id'] = $services_value['parent_id'];
                    $services_arr[$services_value->id]['child'] = array();
                } else {
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['name'] = $services_value['name'];
//                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['parent_id'] = $services_value['parent_id'];
                }
            }
        }

//        pr($services_arr);
//        exit;

        $this->set(compact('userService', 'users', 'services', 'services_arr'));
        $this->set('_serialize', ['userService']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Service id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $servicesTable = TableRegistry::get('Services');
        $services = $servicesTable->find('all', array(
            'fields' => array('id', 'name', 'parent_id'),
            'conditions' => array('Services.status' => 1), 'order' => 'id asc'
        ));

        $service_arr = $parent_arr = array();

        if (!empty($services)) {
            foreach ($services as $services_key => $services_value) {

                if (empty($services_value->parent_id)) {

                    $services_arr[$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->id]['name'] = $services_value['name'];
                    //$services_arr[$services_value->id]['parent_id'] = $services_value['parent_id'];
                    $services_arr[$services_value->id]['child'] = array();
                } else {
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['name'] = $services_value['name'];
//                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['parent_id'] = $services_value['parent_id'];
                }
            }
        }
//        pr($services_arr);
//        pr($userService);
//        exit;

        $userService = $this->UserServices->get($id, [
            'contain' => []
        ]);
//        pr($userService);
//        exit;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['services'] = implode(',', array_filter($this->request->data['services']));
            $userService = $this->UserServices->patchEntity($userService, $this->request->data);
            if ($this->UserServices->save($userService)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Service'));
            }
        }
        $users = $this->UserServices->Users->find('list', [ 'keyField' => 'id',
            'valueField' => 'username',
            'conditions' => array('status' => 1),
            'order' => 'id desc'
        ]);
        $this->set(compact('userService', 'users','services_arr'));
        $this->set('_serialize', ['userService']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $userService = $this->UserServices->get($id);
        if ($this->UserServices->delete($userService)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User Service'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User Service'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
