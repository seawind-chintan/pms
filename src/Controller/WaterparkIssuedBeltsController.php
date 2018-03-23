<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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

            //var_dump($this->request->data);

            $waterparkTicket = $this->WaterparkIssuedBelts->WaterparkTickets->get($this->request->data['ticket_id'], [
                'contain' => []
            ]);

            $waterparkToAssignBelts = $this->WaterparkIssuedBelts->WaterparkBelts->find('all', ['fields' => ['id'], 'conditions' => ['property_id' => $this->request->data['property_id'], 'status' => 1], 'limit' => $waterparkTicket->no_of_persons]);

            $toAssignBelts = $waterparkToAssignBelts->toArray();
            //pr($waterparkTicket->no_of_persons);exit;

            $data = array();
            $belt_data = array();
            for ($nop=1; $nop <= $waterparkTicket->no_of_persons; $nop++) { 
                //var_dump($nop);
                $data[$nop]['property_id'] = $this->request->data['property_id'];
                $data[$nop]['ticket_id'] = $this->request->data['ticket_id'];
                $data[$nop]['belt_id'] = $toAssignBelts[$nop-1]->id;
                $data[$nop]['issued_date'] = date('Y-m-d');
                $data[$nop]['status'] = 0;

                $belt_data[$nop]['id'] = $toAssignBelts[$nop-1]->id;
                $belt_data[$nop]['status'] = 2;
            }

            /*pr($data);
            pr($belt_data);
            exit;*/

            $waterparkIssuedBelts = $this->WaterparkIssuedBelts->newEntities($data);
            //pr($waterparkIssuedBelts);exit;
            if ($this->WaterparkIssuedBelts->saveMany($waterparkIssuedBelts)) {

                $waterparkBeltsTable = TableRegistry::get('WaterparkBelts');
                $list = $waterparkBeltsTable->find('all')->toArray();
                //pr($list);exit;
                $waterbelts = $waterparkBeltsTable->patchEntities($list, $belt_data);
                //pr($waterbelts);exit;
                $this->WaterparkIssuedBelts->WaterparkBelts->saveMany($waterbelts);

                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Belts Bulk'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Belts Bulk'));
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
    public function edit_FEFDFDGVDCXVBCXBDFGF($id = null)
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
    public function delete_XXXFCSDFDSFDGDFGFG($id = null)
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

    public function close($id = null)
    {
        //pr($this->request->data);exit;
        $waterparkIssuedBelt = $this->WaterparkIssuedBelts->get($id, [
            'contain' => ['WaterparkBelts']
        ]);

        $waterparkIssuedBelt->status = 0;
        //$waterparkIssuedBelt->waterpark_belt->status = 1;
        $waterparkBeltsTable = TableRegistry::get('WaterparkBelts');
        $waterparkbelt = $waterparkBeltsTable->get($waterparkIssuedBelt->belt_id);
        //pr($waterparkbelt);
        $waterparkbelt->status = 1;
        //pr($waterparkbelt);exit;
        //$waterparkbeltPatched = $waterparkBeltsTable->patchEntity($waterparkbelt, $this->request->data);
        $waterparkIssuedBelt->waterpark_belt = $waterparkbelt;
        //pr($this->WaterparkIssuedBelts);exit;
        //pr($waterparkIssuedBelt);exit;

        if ($this->WaterparkIssuedBelts->save($waterparkIssuedBelt)) {
            $this->Flash->success(__('The {0} has been saved.', 'Waterpark Issued Belt'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Issued Belt'));
        }
    }
}
