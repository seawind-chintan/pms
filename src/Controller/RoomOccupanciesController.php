<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoomOccupancies Controller
 *
 * @property \App\Model\Table\RoomOccupanciesTable $RoomOccupancies
 *
 * @method \App\Model\Entity\RoomOccupancy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomOccupanciesController extends AppController
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
        if (in_array($this->request->getParam('action'), ['view', 'edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $roomOccId = (int)$this->request->getParam('pass.0');
            $roomOcc = $this->RoomOccupancies->findById($roomOccId)->first();
            if($roomOcc){
                return $roomOcc->user_id === $user['id'];
            } else {
                return false;
            }
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
            'contain' => ['Users']
        ];
        $roomOccupancies = $this->paginate($this->RoomOccupancies, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('roomOccupancies'));
    }

    /**
     * View method
     *
     * @param string|null $id Room Occupancy id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomOccupancy = $this->RoomOccupancies->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('roomOccupancy', $roomOccupancy);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomOccupancy = $this->RoomOccupancies->newEntity();
        if ($this->request->is('post')) {
            $roomOccupancy = $this->RoomOccupancies->patchEntity($roomOccupancy, $this->request->data);
            $roomOccupancy->user_id = $this->Auth->user('id');
            if ($this->RoomOccupancies->save($roomOccupancy)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Occupancy'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Occupancy'));
            }
        }
        $users = $this->RoomOccupancies->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomOccupancy', 'users'));
        $this->set('_serialize', ['roomOccupancy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Occupancy id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomOccupancy = $this->RoomOccupancies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomOccupancy = $this->RoomOccupancies->patchEntity($roomOccupancy, $this->request->data);
            $roomOccupancy->user_id = $this->Auth->user('id');
            if ($this->RoomOccupancies->save($roomOccupancy)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Occupancy'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Occupancy'));
            }
        }
        $users = $this->RoomOccupancies->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomOccupancy', 'users'));
        $this->set('_serialize', ['roomOccupancy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Occupancy id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomOccupancy = $this->RoomOccupancies->get($id);
        if ($this->RoomOccupancies->delete($roomOccupancy)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room Occupancy'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room Occupancy'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
