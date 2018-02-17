<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 *
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
//        pr($_SESSION);
//        pr($this->request);
//        exit;
        //echo $this->Auth->User('id');
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        if (isset($this->request->data['search']) && trim($this->request->data['search']) != '') {
            return $this->redirect(array('action' => 'index', "?" => array('search' => trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if (isset($this->request->query['search']) && trim($this->request->query['search']) != '') {
            $pass_cond = 'Packages.name like "%' . trim($this->request->query['search']) . '%"';
        }

        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => $pass_cond,
            'order' => array('Packages.id desc'),
            'limit' => 2
        ];
        $packages = $this->paginate($this->Packages);

        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $package = $this->Packages->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('package', $package);
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

        $package = $this->Packages->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $this->Auth->User('id');
            $package = $this->Packages->patchEntity($package, $this->request->data);
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The {0} has been saved.', 'Package'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Package'));
            }
        }

//        $users = $this->Packages->Users->find('list', [ 'keyField' => 'id',
//                                                            'valueField' => 'username',
//                                                            'conditions'=>array('status'=>1),
//                                                            'order'=>'id desc'
//                                                        ]);
//        $this->set('users', $users);

        $this->set(compact('package'));
        $this->set('_serialize', ['package']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $package = $this->Packages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['user_id'] = $this->Auth->User('id');

            $package = $this->Packages->patchEntity($package, $this->request->data);
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The {0} has been saved.', 'Package'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Package'));
            }
        }

//        $users = $this->Packages->Users->find('list', [ 'keyField' => 'id',
//                                                            'valueField' => 'username',
//                                                            'conditions'=>array('status'=>1),
//                                                            'order'=>'id desc'
//                                                        ]);
//        $this->set('users', $users);

        $this->set(compact('package'));
        $this->set('_serialize', ['package']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        if ($this->Packages->delete($package)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Package'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Package'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
