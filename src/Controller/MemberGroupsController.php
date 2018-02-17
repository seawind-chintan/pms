<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * MemberGroups Controller
 *
 * @property \App\Model\Table\MemberGroupsTable $MemberGroups
 *
 * @method \App\Model\Entity\MemberGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MemberGroupsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

//        pr($status_options);
//        exit;

        if (isset($this->request->data['search']) && trim($this->request->data['search']) != '') {
            return $this->redirect(array('action' => 'index', "?" => array('search' => trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if (isset($this->request->query['search']) && trim($this->request->query['search']) != '') {
            $pass_cond = 'MemberGroups.name like "%' . trim($this->request->query['search']) . '%"';
        }

        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => $pass_cond,
            'order' => array('MemberGroups.id desc'),
            'limit' => 2
        ];
        
        $memberGroups = $this->paginate($this->MemberGroups);
        $this->set(compact('memberGroups'));
    }

    /**
    * View method
    *
    * @param string|null $id Member Group id.
    * @return \Cake\Http\Response|void
    * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */
    public function view($id = null) {

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $memberGroup = $this->MemberGroups->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('memberGroup', $memberGroup);
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

        $memberGroup = $this->MemberGroups->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $this->Auth->User('id');
            $memberGroup = $this->MemberGroups->patchEntity($memberGroup, $this->request->data);
            if ($this->MemberGroups->save($memberGroup)) {
                $this->Flash->success(__('The {0} has been saved.', 'Member Group'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Member Group'));
            }
        }
        $users = $this->MemberGroups->Users->find('list', ['limit' => 200]);
        $this->set(compact('memberGroup', 'users'));
        $this->set('_serialize', ['memberGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $memberGroup = $this->MemberGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['user_id'] = $this->Auth->User('id');
            $memberGroup = $this->MemberGroups->patchEntity($memberGroup, $this->request->data);
            if ($this->MemberGroups->save($memberGroup)) {
                $this->Flash->success(__('The {0} has been saved.', 'Member Group'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Member Group'));
            }
        }
        $users = $this->MemberGroups->Users->find('list', ['limit' => 200]);
        $this->set(compact('memberGroup', 'users'));
        $this->set('_serialize', ['memberGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $memberGroup = $this->MemberGroups->get($id);
        if ($this->MemberGroups->delete($memberGroup)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Member Group'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Member Group'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
