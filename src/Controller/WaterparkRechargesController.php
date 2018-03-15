<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkRecharges Controller
 *
 * @property \App\Model\Table\WaterparkRechargesTable $WaterparkRecharges
 *
 * @method \App\Model\Entity\WaterparkRecharge[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkRechargesController extends AppController
{

    public function isAuthorized($user)
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            $rechargeId = (int)$this->request->getParam('pass.0');
            $waterparkRecharge = $this->WaterparkRecharges->findById($rechargeId)->first();
            return $waterparkRecharge->user_id === $user['id'];
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Properties']
        ];
        $waterparkRecharges = $this->paginate($this->WaterparkRecharges, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkRecharges'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Recharge id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkRecharge = $this->WaterparkRecharges->get($id, [
            'contain' => ['Users', 'Properties']
        ]);

        $this->set('waterparkRecharge', $waterparkRecharge);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkRecharge = $this->WaterparkRecharges->newEntity();
        if ($this->request->is('post')) {
            $waterparkRecharge = $this->WaterparkRecharges->patchEntity($waterparkRecharge, $this->request->data);
            $waterparkRecharge->user_id = $this->Auth->user('id');
            if ($this->WaterparkRecharges->save($waterparkRecharge)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Recharge'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Recharge'));
            }
        }
        $users = $this->WaterparkRecharges->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkRecharges->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkRecharge', 'users', 'properties'));
        $this->set('_serialize', ['waterparkRecharge']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Recharge id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkRecharge = $this->WaterparkRecharges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkRecharge = $this->WaterparkRecharges->patchEntity($waterparkRecharge, $this->request->data);
            $waterparkRecharge->user_id = $this->Auth->user('id');
            if ($this->WaterparkRecharges->save($waterparkRecharge)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Recharge'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Recharge'));
            }
        }
        $users = $this->WaterparkRecharges->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkRecharges->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkRecharge', 'users', 'properties'));
        $this->set('_serialize', ['waterparkRecharge']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Recharge id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkRecharge = $this->WaterparkRecharges->get($id);
        if ($this->WaterparkRecharges->delete($waterparkRecharge)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Recharge'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Recharge'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
