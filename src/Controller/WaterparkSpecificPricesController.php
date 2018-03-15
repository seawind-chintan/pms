<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkSpecificPrices Controller
 *
 * @property \App\Model\Table\WaterparkSpecificPricesTable $WaterparkSpecificPrices
 *
 * @method \App\Model\Entity\WaterparkSpecificPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkSpecificPricesController extends AppController
{
    public function isAuthorized($user)
    {
        // All registered users can add articles
        // Prior to 3.4.0 $this->request->param('action') was used.
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $priceId = (int)$this->request->getParam('pass.0');
            $waterparkSpecificPrice = $this->WaterparkSpecificPrices->findById($priceId)->first();
            
            return $waterparkSpecificPrice->user_id === $user['id'];
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
            'contain' => ['Properties']
        ];
        $waterparkSpecificPrices = $this->paginate($this->WaterparkSpecificPrices, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkSpecificPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Specific Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkSpecificPrice = $this->WaterparkSpecificPrices->get($id, [
            'contain' => ['Properties']
        ]);

        $this->set('waterparkSpecificPrice', $waterparkSpecificPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkSpecificPrice = $this->WaterparkSpecificPrices->newEntity();
        if ($this->request->is('post')) {
            $waterparkSpecificPrice = $this->WaterparkSpecificPrices->patchEntity($waterparkSpecificPrice, $this->request->data);
            if ($this->WaterparkSpecificPrices->save($waterparkSpecificPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Specific Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Specific Price'));
            }
        }
        $properties = $this->WaterparkSpecificPrices->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkSpecificPrice', 'properties'));
        $this->set('_serialize', ['waterparkSpecificPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Specific Price id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkSpecificPrice = $this->WaterparkSpecificPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkSpecificPrice = $this->WaterparkSpecificPrices->patchEntity($waterparkSpecificPrice, $this->request->data);
            if ($this->WaterparkSpecificPrices->save($waterparkSpecificPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Specific Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Specific Price'));
            }
        }
        $properties = $this->WaterparkSpecificPrices->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkSpecificPrice', 'properties'));
        $this->set('_serialize', ['waterparkSpecificPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Specific Price id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkSpecificPrice = $this->WaterparkSpecificPrices->get($id);
        if ($this->WaterparkSpecificPrices->delete($waterparkSpecificPrice)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Specific Price'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Specific Price'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
