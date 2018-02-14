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
            'contain' => []
        ]);

        $this->set('roomStatus', $roomStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomStatus = $this->RoomStatuses->newEntity();
        if ($this->request->is('post')) {
            $roomStatus = $this->RoomStatuses->patchEntity($roomStatus, $this->request->getData());
            if ($this->RoomStatuses->save($roomStatus)) {
                $this->Flash->success(__('The room status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room status could not be saved. Please, try again.'));
        }
        $this->set(compact('roomStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomStatus = $this->RoomStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomStatus = $this->RoomStatuses->patchEntity($roomStatus, $this->request->getData());
            if ($this->RoomStatuses->save($roomStatus)) {
                $this->Flash->success(__('The room status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room status could not be saved. Please, try again.'));
        }
        $this->set(compact('roomStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomStatus = $this->RoomStatuses->get($id);
        if ($this->RoomStatuses->delete($roomStatus)) {
            $this->Flash->success(__('The room status has been deleted.'));
        } else {
            $this->Flash->error(__('The room status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
