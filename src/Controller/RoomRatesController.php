<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoomRates Controller
 *
 * @property \App\Model\Table\RoomRatesTable $RoomRates
 *
 * @method \App\Model\Entity\RoomRate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomRatesController extends AppController
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
            $roomRateId = (int)$this->request->getParam('pass.0');
            $roomRate = $this->RoomRates->findById($roomRateId)->first();
            if($roomRate){
                return $roomRate->user_id === $user['id'];
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
            'contain' => ['Users', 'Properties', 'RoomPlans', 'RoomTypes', 'RoomOccupancies']
        ];
        $roomRates = $this->paginate($this->RoomRates, ['conditions' => ['RoomRates.user_id' => $this->Auth->user('id')]]);

        $this->set(compact('roomRates'));
    }

    public function getspecificrates()
    {
        if($this->request->is('ajax')) {
            //$this->layout = 'ajax';
            $this->viewBuilder()->setLayout('ajax');

            $property_id = $this->request->data()['myData']['property_id'];
            $room_type_id = $this->request->data()['myData']['room_type_id'];
            $room_occupancy_id = $this->request->data()['myData']['room_occupancy_id'];

            $this->paginate = [
                'contain' => ['Users', 'Properties', 'RoomPlans', 'RoomTypes', 'RoomOccupancies']
            ];
            $roomRates = $this->paginate($this->RoomRates, ['conditions' => ['RoomRates.user_id' => $this->Auth->user('id'), 'property_id' => $property_id, 'room_type_id' => $room_type_id, 'room_occupancy_id' => $room_occupancy_id ]]);

            //pr($roomRates);exit;
            $this->set('roomRates', $roomRates);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Room Rate id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomRate = $this->RoomRates->get($id, [
            'contain' => ['Users', 'Properties', 'RoomPlans', 'RoomTypes', 'RoomOccupancies']
        ]);

        $this->set('roomRate', $roomRate);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomRate = $this->RoomRates->newEntity();
        if ($this->request->is('post')) {
            $roomRate = $this->RoomRates->patchEntity($roomRate, $this->request->data);
            $roomRate->user_id = $this->Auth->user('id');
            if ($this->RoomRates->save($roomRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Rate'));
            }
        }
        $users = $this->RoomRates->Users->find('list', ['limit' => 200]);
        $properties = $this->RoomRates->Properties->find('list', ['conditions' => ['status'=>1, 'type'=>1, 'user' => $this->Auth->user('id')],'limit' => 200]);
        $roomPlans = $this->RoomRates->RoomPlans->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $roomTypes = $this->RoomRates->RoomTypes->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $roomOccupancies = $this->RoomRates->RoomOccupancies->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $this->set(compact('roomRate', 'users', 'properties', 'roomPlans', 'roomTypes', 'roomOccupancies'));
        $this->set('_serialize', ['roomRate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Rate id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomRate = $this->RoomRates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomRate = $this->RoomRates->patchEntity($roomRate, $this->request->data);
            $roomRate->user_id = $this->Auth->user('id');
            if ($this->RoomRates->save($roomRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Rate'));
            }
        }
        $users = $this->RoomRates->Users->find('list', ['limit' => 200]);
        $properties = $this->RoomRates->Properties->find('list', ['conditions' => ['status'=>1, 'type'=>1, 'user' => $this->Auth->user('id')],'limit' => 200]);
        $roomPlans = $this->RoomRates->RoomPlans->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $roomTypes = $this->RoomRates->RoomTypes->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $roomOccupancies = $this->RoomRates->RoomOccupancies->find('list', ['conditions' => ['status'=>1, 'user_id' => $this->Auth->user('id')],'limit' => 200]);
        $this->set(compact('roomRate', 'users', 'properties', 'roomPlans', 'roomTypes', 'roomOccupancies'));
        $this->set('_serialize', ['roomRate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Rate id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomRate = $this->RoomRates->get($id);
        if ($this->RoomRates->delete($roomRate)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room Rate'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room Rate'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
