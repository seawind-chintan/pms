<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoomStatuses Controller
 *
 * @property \App\Model\Table\RoomStatusesTable $RoomStatuses
 *
 * @method \App\Model\Entity\RoomStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $roomStatuses = $this->paginate($this->RoomStatuses);

        $this->set(compact('roomStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Room Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomStatus = $this->RoomStatuses->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('roomStatus', $roomStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomStatus = $this->RoomStatuses->newEntity();
        if ($this->request->is('post')) {
            $roomStatus = $this->RoomStatuses->patchEntity($roomStatus, $this->request->data);
            if ($this->RoomStatuses->save($roomStatus)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Status'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Status'));
            }
        }
        $users = $this->RoomStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomStatus', 'users'));
        $this->set('_serialize', ['roomStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Status id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomStatus = $this->RoomStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomStatus = $this->RoomStatuses->patchEntity($roomStatus, $this->request->data);
            if ($this->RoomStatuses->save($roomStatus)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Status'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Status'));
            }
        }
        $users = $this->RoomStatuses->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomStatus', 'users'));
        $this->set('_serialize', ['roomStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomStatus = $this->RoomStatuses->get($id);
        if ($this->RoomStatuses->delete($roomStatus)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room Status'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room Status'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
