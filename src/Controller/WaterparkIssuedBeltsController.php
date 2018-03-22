<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkIssuedBelts Controller
 *
 * @property \App\Model\Table\WaterparkIssuedBeltsTable $WaterparkIssuedBelts
 *
 * @method \App\Model\Entity\WaterparkIssuedBelt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkIssuedBeltsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Properties', 'WaterparkTickets', 'WaterparkBelts']
        ];
        $waterparkIssuedBelts = $this->paginate($this->WaterparkIssuedBelts);

        $this->set(compact('waterparkIssuedBelts'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Issued Belt id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkIssuedBelt = $this->WaterparkIssuedBelts->get($id, [
            'contain' => ['Properties', 'WaterparkTickets', 'WaterparkBelts']
        ]);

        $this->set('waterparkIssuedBelt', $waterparkIssuedBelt);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkIssuedBelt = $this->WaterparkIssuedBelts->newEntity();
        if ($this->request->is('post')) {

            var_dump($this->request->data);

            $waterparkTicket = $this->WaterparkIssuedBelts->WaterparkTickets->get($this->request->data['ticket_id'], [
                'contain' => []
            ]);

            pr($waterparkTicket->no_of_persons);

            $data = array();
            for ($nop=1; $nop <= $waterparkTicket->no_of_persons; $nop++) { 
                var_dump($nop);
                $data[$nop]['property_id'] = $this->request->data['property_id'];
                $data[$nop]['ticket_id'] = $this->request->data['ticket_id'];
            }

            pr($data);

            exit;
            $waterparkIssuedBelt = $this->WaterparkIssuedBelts->patchEntity($waterparkIssuedBelt, $this->request->data);
            if ($this->WaterparkIssuedBelts->save($waterparkIssuedBelt)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Issued Belt'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Issued Belt'));
            }
        }
        $properties = $this->WaterparkIssuedBelts->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $waterparkTickets = $this->WaterparkIssuedBelts->WaterparkTickets->find('list', ['conditions' => ['WaterparkTickets.status' => 1], 'limit' => 200]);
        $waterparkBelts = $this->WaterparkIssuedBelts->WaterparkBelts->find('list', ['limit' => 200]);
        $this->set(compact('waterparkIssuedBelt', 'properties', 'waterparkTickets', 'waterparkBelts'));
        $this->set('_serialize', ['waterparkIssuedBelt']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Issued Belt id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkIssuedBelt = $this->WaterparkIssuedBelts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkIssuedBelt = $this->WaterparkIssuedBelts->patchEntity($waterparkIssuedBelt, $this->request->data);
            if ($this->WaterparkIssuedBelts->save($waterparkIssuedBelt)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Issued Belt'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Issued Belt'));
            }
        }
        $properties = $this->WaterparkIssuedBelts->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $waterparkTickets = $this->WaterparkIssuedBelts->WaterparkTickets->find('list', ['limit' => 200]);
        $waterparkBelts = $this->WaterparkIssuedBelts->WaterparkBelts->find('list', ['limit' => 200]);
        $this->set(compact('waterparkIssuedBelt', 'properties', 'waterparkTickets', 'waterparkBelts'));
        $this->set('_serialize', ['waterparkIssuedBelt']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Issued Belt id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkIssuedBelt = $this->WaterparkIssuedBelts->get($id);
        if ($this->WaterparkIssuedBelts->delete($waterparkIssuedBelt)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Issued Belt'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Issued Belt'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
