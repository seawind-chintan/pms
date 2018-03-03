<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Checkins Controller
 *
 * @property \App\Model\Table\CheckinsTable $Checkins
 *
 * @method \App\Model\Entity\Checkin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckinsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Properties']
        ];
        $checkins = $this->paginate($this->Checkins);

        $this->set(compact('checkins'));
    }

    /**
     * View method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkin = $this->Checkins->get($id, [
            'contain' => ['Members', 'Cities', 'States', 'Countries', 'Properties', 'CheckinRoomsRates']
        ]);

        $this->set('checkin', $checkin);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($roomId = false)
    {
        $checkin = $this->Checkins->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->data);exit;
            $checkin = $this->Checkins->patchEntity($checkin, $this->request->data);
            $checkin->member->parent = $this->Auth->user('id');
            if(!empty($this->request->data['member']['id'])) $checkin->member->id = $this->request->data['member']['id'];
            //pr($checkin);exit;
            if ($checkinID = $this->Checkins->save($checkin)) {

                /*$checkinRoomsRatesTable = TableRegistry::get('CheckinRoomsRates');
                $rooms_to_save = $this->request->data['rooms'];
                foreach ($rooms_to_save as $room_to_save_key => $room_to_save) {
                    $checkinroomrate = $checkinRoomsRatesTable->newEntity();
                    $checkinroomrate->checkin_id = $checkinID->id;
                    $checkinroomrate->room_id = $room_to_save;
                    $checkinroomrate->room_rate_id = $this->request->data['roomratebyplan'][$room_to_save_key];
                    $checkinroomrate->no_of_adult = (!empty($this->request->data['adultbyroomrate'][$room_to_save_key]) ? $this->request->data['adultbyroomrate'][$room_to_save_key] : 1 );
                    $checkinroomrate->no_of_child = (!empty($this->request->data['childbyroomrate'][$room_to_save_key]) ? $this->request->data['childbyroomrate'][$room_to_save_key] : 0 );
                    //pr($checkinroomrate);exit;
                    $checkinRoomsRatesTable->save($checkinroomrate);
                }*/

                $RoomsTable = TableRegistry::get('Rooms');
                foreach ($checkin['checkin_rooms_rates'] as $checkin_room_key => $checkin_room) {
                    $room = $RoomsTable->get($checkin_room->room_id);
                    $room->room_status_id = 5;
                    $RoomsTable->save($room);
                }

                $this->Flash->success(__('The {0} has been saved.', 'Checkin'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin'));
            }
        }
        $members = $this->Checkins->Members->find('list', ['limit' => 200]);
        $cities = $this->Checkins->Members->Cities->find('list', ['limit' => 200]);
        $states = $this->Checkins->Members->States->find('list', ['limit' => 200]);
        $countries = $this->Checkins->Members->Countries->find('list', ['limit' => 200]);
        $properties = $this->Checkins->Properties->find('list', ['conditions' => ['type' => 1, 'status' => 1, 'user' => $this->Auth->user('id')], 'limit' => 200]);

        $this->set(compact('checkin', 'members', 'cities', 'states', 'countries', 'properties'));
        $this->set('_serialize', ['checkin']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkin = $this->Checkins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkin = $this->Checkins->patchEntity($checkin, $this->request->data);
            if ($this->Checkins->save($checkin)) {
                $this->Flash->success(__('The {0} has been saved.', 'Checkin'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Checkin'));
            }
        }
        $members = $this->Checkins->Members->find('list', ['limit' => 200]);
        $cities = $this->Checkins->Cities->find('list', ['limit' => 200]);
        $states = $this->Checkins->States->find('list', ['limit' => 200]);
        $countries = $this->Checkins->Countries->find('list', ['limit' => 200]);
        $properties = $this->Checkins->Properties->find('list', ['limit' => 200]);
        $this->set(compact('checkin', 'members', 'cities', 'states', 'countries', 'properties'));
        $this->set('_serialize', ['checkin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkin = $this->Checkins->get($id);
        if ($this->Checkins->delete($checkin)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Checkin'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Checkin'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
