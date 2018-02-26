<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CheckinRoomsRates Controller
 *
 * @property \App\Model\Table\CheckinRoomsRatesTable $CheckinRoomsRates
 *
 * @method \App\Model\Entity\CheckinRoomsRate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckinRoomsRatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Checkins', 'Rooms', 'RoomRates']
        ];
        $checkinRoomsRates = $this->paginate($this->CheckinRoomsRates);

        $this->set(compact('checkinRoomsRates'));
    }

    /**
     * View method
     *
     * @param string|null $id Checkin Rooms Rate id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkinRoomsRate = $this->CheckinRoomsRates->get($id, [
            'contain' => ['Checkins', 'Rooms', 'RoomRates']
        ]);

        $this->set('checkinRoomsRate', $checkinRoomsRate);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkinRoomsRate = $this->CheckinRoomsRates->newEntity();
        if ($this->request->is('post')) {
            $checkinRoomsRate = $this->CheckinRoomsRates->patchEntity($checkinRoomsRate, $this->request->data);
            if ($this->CheckinRoomsRates->save($checkinRoomsRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Rooms Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Rooms Rate'));
            }
        }
        $checkins = $this->CheckinRoomsRates->Checkins->find('list', ['limit' => 200]);
        $rooms = $this->CheckinRoomsRates->Rooms->find('list', ['limit' => 200]);
        $roomRates = $this->CheckinRoomsRates->RoomRates->find('list', ['limit' => 200]);
        $this->set(compact('checkinRoomsRate', 'checkins', 'rooms', 'roomRates'));
        $this->set('_serialize', ['checkinRoomsRate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkin Rooms Rate id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkinRoomsRate = $this->CheckinRoomsRates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkinRoomsRate = $this->CheckinRoomsRates->patchEntity($checkinRoomsRate, $this->request->data);
            if ($this->CheckinRoomsRates->save($checkinRoomsRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin Rooms Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin Rooms Rate'));
            }
        }
        $checkins = $this->CheckinRoomsRates->Checkins->find('list', ['limit' => 200]);
        $rooms = $this->CheckinRoomsRates->Rooms->find('list', ['limit' => 200]);
        $roomRates = $this->CheckinRoomsRates->RoomRates->find('list', ['limit' => 200]);
        $this->set(compact('checkinRoomsRate', 'checkins', 'rooms', 'roomRates'));
        $this->set('_serialize', ['checkinRoomsRate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkin Rooms Rate id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkinRoomsRate = $this->CheckinRoomsRates->get($id);
        if ($this->CheckinRoomsRates->delete($checkinRoomsRate)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Checkin Rooms Rate'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Checkin Rooms Rate'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
