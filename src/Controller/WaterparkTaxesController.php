<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkTaxes Controller
 *
 * @property \App\Model\Table\WaterparkTaxesTable $WaterparkTaxes
 *
 * @method \App\Model\Entity\WaterparkTax[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkTaxesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $this->paginate = [
            'contain' => ['Users', 'RestaurantMenuTypes'],
            'conditions'=> ['Users.id'=>$club_admin_user_id],
            'order'=>array('WaterparkTaxes.id desc'),
        ];

        $waterparkTaxes = $this->paginate($this->WaterparkTaxes);

        $this->set(compact('waterparkTaxes'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Tax id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkTax = $this->WaterparkTaxes->get($id, [
            'contain' => ['Users', 'RestaurantMenuTypes']
        ]);

        $this->set('waterparkTax', $waterparkTax);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $waterparkTax = $this->WaterparkTaxes->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $club_admin_user_id;
            $waterparkTax = $this->WaterparkTaxes->patchEntity($waterparkTax, $this->request->data);

//            pr($waterparkTax);
//            exit;

            if ($this->WaterparkTaxes->save($waterparkTax)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Tax'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Tax'));
            }
        }


        $users = $this->WaterparkTaxes->Users->find('list', ['limit' => 200]);
        $restaurantMenuTypes = $this->WaterparkTaxes->RestaurantMenuTypes->find('list', ['conditions'=> ['RestaurantMenuTypes.user_id'=>$club_admin_user_id], 'limit' => 200]);
        $this->set(compact('waterparkTax', 'users', 'restaurantMenuTypes'));
        $this->set('_serialize', ['waterparkTax']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Tax id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkTax = $this->WaterparkTaxes->get($id, [
            'contain' => []
        ]);

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['user_id'] = $club_admin_user_id;
            $waterparkTax = $this->WaterparkTaxes->patchEntity($waterparkTax, $this->request->data);
            if ($this->WaterparkTaxes->save($waterparkTax)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Tax'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Tax'));
            }
        }
        $users = $this->WaterparkTaxes->Users->find('list', ['limit' => 200]);
        $restaurantMenuTypes = $this->WaterparkTaxes->RestaurantMenuTypes->find('list', ['limit' => 200]);
        $this->set(compact('waterparkTax', 'users', 'restaurantMenuTypes'));
        $this->set('_serialize', ['waterparkTax']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Tax id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkTax = $this->WaterparkTaxes->get($id);
        if ($this->WaterparkTaxes->delete($waterparkTax)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Tax'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Tax'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
