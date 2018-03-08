<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CheckinBillings Controller
 *
 * @property \App\Model\Table\CheckinBillingsTable $CheckinBillings
 *
 * @method \App\Model\Entity\CheckinBilling[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckinBillingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Checkins']
        ];
        $checkinBillings = $this->paginate($this->CheckinBillings);

        $this->set(compact('checkinBillings'));
    }

    /**
     * View method
     *
     * @param string|null $id Checkin Billing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkinBilling = $this->CheckinBillings->get($id, [
            'contain' => ['Checkins']
        ]);

        $this->set('checkinBilling', $checkinBilling);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkinBilling = $this->CheckinBillings->newEntity();
        if ($this->request->is('post')) {
            $checkinBilling = $this->CheckinBillings->patchEntity($checkinBilling, $this->request->data);
            if ($this->CheckinBillings->save($checkinBilling)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Billing'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Billing'));
            }
        }
        $checkins = $this->CheckinBillings->Checkins->find('list', ['limit' => 200]);
        $this->set(compact('checkinBilling', 'checkins'));
        $this->set('_serialize', ['checkinBilling']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkin Billing id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkinBilling = $this->CheckinBillings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkinBilling = $this->CheckinBillings->patchEntity($checkinBilling, $this->request->data);
            if ($this->CheckinBillings->save($checkinBilling)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Billing'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Billing'));
            }
        }
        $checkins = $this->CheckinBillings->Checkins->find('list', ['limit' => 200]);
        $this->set(compact('checkinBilling', 'checkins'));
        $this->set('_serialize', ['checkinBilling']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkin Billing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkinBilling = $this->CheckinBillings->get($id);
        if ($this->CheckinBillings->delete($checkinBilling)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Checkin Billing'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Checkin Billing'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
