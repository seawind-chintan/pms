<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkTickets Controller
 *
 * @property \App\Model\Table\WaterparkTicketsTable $WaterparkTickets
 *
 * @method \App\Model\Entity\WaterparkTicket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkTicketsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Properties', 'Users', 'Members' => function(\Cake\ORM\Query $q) {
                return $q->where(['WaterparkTickets.member_type' => false]);
            }]
        ];
        $waterparkTickets = $this->paginate($this->WaterparkTickets);
        pr($waterparkTickets);exit;
        $this->set(compact('waterparkTickets'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Ticket id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkTicket = $this->WaterparkTickets->get($id, [
            'contain' => ['Properties', 'Users', 'Members']
        ]);

        $this->set('waterparkTicket', $waterparkTicket);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkTicket = $this->WaterparkTickets->newEntity();
        if ($this->request->is('post')) {
            $waterparkTicket = $this->WaterparkTickets->patchEntity($waterparkTicket, $this->request->data);
            $waterparkTicket->user_id = $this->Auth->user('id');
            if ($this->WaterparkTickets->save($waterparkTicket)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Ticket'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Ticket'));
            }
        }
        $properties = $this->WaterparkTickets->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $users = $this->WaterparkTickets->Users->find('list', ['limit' => 200]);
        $members = $this->WaterparkTickets->Members->find('list', ['limit' => 200]);
        $this->set(compact('waterparkTicket', 'properties', 'users', 'members'));
        $this->set('_serialize', ['waterparkTicket']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Ticket id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkTicket = $this->WaterparkTickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkTicket = $this->WaterparkTickets->patchEntity($waterparkTicket, $this->request->data);
            $waterparkTicket->user_id = $this->Auth->user('id');
            if ($this->WaterparkTickets->save($waterparkTicket)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Ticket'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Ticket'));
            }
        }
        $properties = $this->WaterparkTickets->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $users = $this->WaterparkTickets->Users->find('list', ['limit' => 200]);
        $members = $this->WaterparkTickets->Members->find('list', ['limit' => 200]);
        $this->set(compact('waterparkTicket', 'properties', 'users', 'members'));
        $this->set('_serialize', ['waterparkTicket']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Ticket id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkTicket = $this->WaterparkTickets->get($id);
        if ($this->WaterparkTickets->delete($waterparkTicket)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Ticket'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Ticket'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
