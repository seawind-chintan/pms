<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CheckinStatuses Controller
 *
 * @property \App\Model\Table\CheckinStatusesTable $CheckinStatuses
 *
 * @method \App\Model\Entity\CheckinStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckinStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $checkinStatuses = $this->paginate($this->CheckinStatuses);

        $this->set(compact('checkinStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Checkin Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkinStatus = $this->CheckinStatuses->get($id, [
            'contain' => []
        ]);

        $this->set('checkinStatus', $checkinStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkinStatus = $this->CheckinStatuses->newEntity();
        if ($this->request->is('post')) {
            $checkinStatus = $this->CheckinStatuses->patchEntity($checkinStatus, $this->request->data);
            if ($this->CheckinStatuses->save($checkinStatus)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Status'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Status'));
            }
        }
        $this->set(compact('checkinStatus'));
        $this->set('_serialize', ['checkinStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkin Status id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkinStatus = $this->CheckinStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkinStatus = $this->CheckinStatuses->patchEntity($checkinStatus, $this->request->data);
            if ($this->CheckinStatuses->save($checkinStatus)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Status'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Status'));
            }
        }
        $this->set(compact('checkinStatus'));
        $this->set('_serialize', ['checkinStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkin Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkinStatus = $this->CheckinStatuses->get($id);
        if ($this->CheckinStatuses->delete($checkinStatus)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Checkin Status'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Checkin Status'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
