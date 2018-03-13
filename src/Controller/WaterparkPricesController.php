<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkPrices Controller
 *
 * @property \App\Model\Table\WaterparkPricesTable $WaterparkPrices
 *
 * @method \App\Model\Entity\WaterparkPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkPricesController extends AppController
{

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
        $waterparkPrices = $this->paginate($this->WaterparkPrices);

        $this->set(compact('waterparkPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkPrice = $this->WaterparkPrices->get($id, [
            'contain' => ['Properties']
        ]);

        $this->set('waterparkPrice', $waterparkPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkPrice = $this->WaterparkPrices->newEntity();
        if ($this->request->is('post')) {
            $waterparkPrice = $this->WaterparkPrices->patchEntity($waterparkPrice, $this->request->data);
            if ($this->WaterparkPrices->save($waterparkPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Price'));
            }
        }
        $properties = $this->WaterparkPrices->Properties->find('list', ['conditions' => ['type' => 5], 'limit' => 200]);
        $this->set(compact('waterparkPrice', 'properties'));
        $this->set('_serialize', ['waterparkPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkPrice = $this->WaterparkPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkPrice = $this->WaterparkPrices->patchEntity($waterparkPrice, $this->request->data);
            if ($this->WaterparkPrices->save($waterparkPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Price'));
            }
        }
        $properties = $this->WaterparkPrices->Properties->find('list', ['conditions' => ['type' => 5], 'limit' => 200]);
        $this->set(compact('waterparkPrice', 'properties'));
        $this->set('_serialize', ['waterparkPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkPrice = $this->WaterparkPrices->get($id);
        if ($this->WaterparkPrices->delete($waterparkPrice)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Price'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Price'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
