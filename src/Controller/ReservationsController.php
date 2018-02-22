<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Wizard');
    }

    public function beforeFilter(Event $event) {
        $reservation = $this->Reservations->newEntity();
        $reservationtypes = $this->getReservationTypes();
        $properties = $this->Reservations->Properties->find('list', ['conditions' => ['user' => $this->Auth->user('id'), 'type' => 1], 'limit' => 200]);
        $roomplans = $this->Reservations->RoomPlans->find('list', ['conditions' => ['user_id' => $this->Auth->user('id'), 'status' => 1], 'limit' => 200]);
        $roomtypes = $this->Reservations->RoomTypes->find('list', ['conditions' => ['user_id' => $this->Auth->user('id'), 'status' => 1], 'limit' => 200]);
        $roomoccupancies = $this->Reservations->RoomOccupancies->find('list', ['conditions' => ['user_id' => $this->Auth->user('id'), 'status' => 1], 'limit' => 200]);

        $members = $this->Reservations->Members->find('list', ['limit' => 200]);
        $membertypes = $this->getMemberTypes();
        $cities = $this->Reservations->Cities->find('list', ['limit' => 200]);
        $states = $this->Reservations->States->find('list', ['limit' => 200]);
        
        $countries = $this->Reservations->Countries->find('list', ['limit' => 200]);
        
        $wizardData = $this->Wizard->read();
        //extract($wizardData);

        //pr($wizardData);

        if(!empty($wizardData['step1']['property_id'])){
            $roomsTable = TableRegistry::get('RoomRates');
            $rooms = $roomsTable->find('all', [
                'contain' => ['RoomTypes', 'RoomOccupancies', 'RoomPlans'],
                'conditions' => ['RoomRates.status' => 1, 'RoomRates.property_id' => $wizardData['step1']['property_id']]
            ]);
            $totalRooms = count($rooms->toArray());
            $this->set(compact('rooms','totalRooms'));
        }

        $this->set(compact('reservation', 'members', 'membertypes', 'reservationtypes', 'cities', 'states', 'countries', 'properties', 'roomplans', 'roomtypes', 'roomoccupancies', 'wizardData'));

        //$this->set(compact('reservation','reservationtypes', 'properties'));
        $this->Wizard->steps = array('step1', 'step2', 'step3', 'step4');
        $this->Wizard->completeUrl = '/reservations';
    }

    public function wizard($step = null, $id=null) {
        $this->Wizard->process($step);
    }

    public function setErrors($modelErrors){
        $error_msg = [];
        foreach( $modelErrors as $errors){
            if(is_array($errors)){
                foreach($errors as $error){
                    $error_msg[] = $error;
                }
            }else{
                $error_msg[] = $errors;
            }
        }
        return $error_msg;
    }

    /**
     * [Wizard Process Callbacks]
     */
    public function processStep1() {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data, ['validate'=>'step1']);
            if ($reservation->errors()) {
                // Entity failed validation.
                $error_msg = $this->setErrors($reservation->errors());
                //pr($error_msg);exit;
                //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
                $this->Flash->error(
                        __("Please fix the following error(s):".implode("\n \r", $error_msg))
                    );
                return false;
            } else {
                return true;
            }
            /*if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
            }*/
        }
        /*$this->Client->set($this->data);
        $this->User->set($this->data);

        if($this->Client->validates() && $this->User->validates()) {
            return true;
        }
        return false;*/
    }

    public function processStep2() {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data, ['validate'=>'step2']);
            if ($reservation->errors()) {
                // Entity failed validation.
                $error_msg = $this->setErrors($reservation->errors());
                //pr($error_msg);exit;
                //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
                $this->Flash->error(
                        __("Please fix the following error(s):".implode("\n \r", $error_msg))
                    );
                return false;
            } else {
                return true;
            }
        }
    }

    public function processStep3() {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data, ['validate'=>'step3']);
            if ($reservation->errors()) {
                // Entity failed validation.
                $error_msg = $this->setErrors($reservation->errors());
                //pr($error_msg);exit;
                //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
                $this->Flash->error(
                        __("Please fix the following error(s):".implode("\n \r", $error_msg))
                    );
                return false;
            } else {
                return true;
            }
        }
    }

    public function processStep4() {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data, ['validate'=>'step4']);
            if ($reservation->errors()) {
                // Entity failed validation.
                $error_msg = $this->setErrors($reservation->errors());
                //pr($error_msg);exit;
                //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
                $this->Flash->error(
                        __("Please fix the following error(s):".implode("\n \r", $error_msg))
                    );
                return false;
            } else {
                return true;
            }
        }
    }

    
    /*public function processReview() {
        return true;
    }*/

    /**
     * [Wizard Completion Callback]
     */
    public function afterComplete() {
        //echo "after completed....";exit;
        $wizardData = $this->Wizard->read();
        extract($wizardData);
        //pr($wizardData);
        //exit;
        $postData = array_merge($wizardData['step1'], $wizardData['step2'], $wizardData['step3'], $wizardData['step4']);
        $memberData = $wizardData['step3'];
        $memberData['code'] = 'NA';
        $memberData['application_no'] = 'NA';
        $memberData['pancard'] = 'NA';
        $memberData['gender'] = 'NA';
        if(empty($memberData['email'])) { $memberData['email'] = 'test@mail.com'; }
        $memberData['cor_address'] = $memberData['address'];unset($memberData['address']);
        $memberData['cor_city'] = $memberData['city_id'];unset($memberData['city_id']);
        $memberData['cor_state'] = $memberData['state_id'];unset($memberData['state_id']);
        $memberData['cor_country'] = $memberData['country_id'];unset($memberData['country_id']);
        $memberData['cor_pincode'] = $memberData['pincode'];unset($memberData['pincode']);
        $memberData['status'] = 1;
        //pr($memberData);
        //pr($postData);exit;

        /*$membersTable = TableRegistry::get('Members');
        $members = $membersTable->newEntity();
        $members = $membersTable->patchEntity($members, $memberData);
        $result = $membersTable->save($members);
        pr($result);exit;*/

        $membersTable = TableRegistry::get('Members');
        $member = $membersTable->newEntity();
        $member->parent = $this->Auth->user('id');
        $member = $membersTable->patchEntity($member, $memberData);
        //pr($member);exit;
        if ($membersTable->save($member)) { //$membersTable->save($member)
            //$this->Flash->success(__('The {0} has been saved.', 'Reservation'));
            //return $this->redirect(['action' => 'index']);
            //pr($member_save_result);exit;
            $member_id = $member->id;
            $postData['member_id'] = $member_id ;
            $reservation = $this->Reservations->newEntity();
            $reservation = $this->Reservations->patchEntity($reservation, $postData);
            $room_number_arr = $wizardData['step2']['select_room_number'];
            $no_of_rooms = 0;
            foreach ($room_number_arr as $room_number_data) {
                $no_of_rooms += (int) $room_number_data;
            }
            $reservation->no_of_rooms = $no_of_rooms;
            //pr($reservation);exit;
            //$result = $this->Reservations->save($reservation);pr($result);
            //exit;
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation'));

                $reservation_id = $reservation->id;
                
                foreach ($room_number_arr as $room_number_key => $room_number_value) {
                    $reservationRatesData[$room_number_key]['no_of_rooms'] = $room_number_value;
                    $reservationRatesData[$room_number_key]['reservation_id'] = $reservation_id;
                }

                $room_rates_arr = $wizardData['step2']['room_rates'];
                foreach ($room_rates_arr as $room_rates_key => $room_rates_value) {
                    $reservationRatesData[$room_rates_key]['room_rate_id'] = $room_rates_value;
                }

                $room_adult_arr = $wizardData['step2']['select_room_adult'];
                foreach ($room_adult_arr as $room_adult_key => $room_adult_value) {
                    $reservationRatesData[$room_adult_key]['no_of_adult'] = $room_adult_value;
                }

                $room_child_arr = $wizardData['step2']['select_room_child'];
                foreach ($room_child_arr as $room_child_key => $room_child_value) {
                    $reservationRatesData[$room_child_key]['no_of_child'] = $room_child_value;
                }

                //pr($reservationRatesData);
                //exit;
                //$reservationRatesData['reservation_id'] = $reservation_id;
                $ReservationRatesTable = TableRegistry::get('ReservationRates');
                $reservations_entities = $ReservationRatesTable->newEntities($reservationRatesData);
                //pr($reservations_entities);exit;
                $result = $ReservationRatesTable->saveMany($reservations_entities);
                //$reservation_rates = $ReservationRatesTable->newEntity();
                //$reservation_rates = $ReservationRatesTable->patchEntity($reservation_rates, $reservationRatesData);
                
                //$ReservationRatesTable->save($reservation_rates);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
            }
        } else {
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
        }
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Cities', 'States', 'Countries', 'Properties']
        ];
        $reservations = $this->paginate($this->Reservations, ['conditions' => ['Properties.user' => $this->Auth->user('id')]]);

        $this->set(compact('reservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Members', 'Cities', 'States', 'Countries', 'ReservationRooms']
        ]);

        $this->set('reservation', $reservation);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add_X()
    {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
            }
        }
        $members = $this->Reservations->Members->find('list', ['limit' => 200]);
        $membertypes = $this->getMemberTypes();
        $reservationtypes = $this->getReservationTypes();
        $cities = $this->Reservations->Cities->find('list', ['limit' => 200]);
        $states = $this->Reservations->States->find('list', ['limit' => 200]);

        $roomsTable = TableRegistry::get('Rooms');
        $rooms = $roomsTable->find('all', [
            'conditions' => ['Rooms.status' => 1]
        ]);

        $totalRooms = count($rooms->toArray());

        $countries = $this->Reservations->Countries->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'members', 'membertypes', 'reservationtypes', 'cities', 'states', 'countries', 'totalRooms'));
        $this->set('_serialize', ['reservation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit_X($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
            }
        }
        $members = $this->Reservations->Members->find('list', ['limit' => 200]);
        $cities = $this->Reservations->Cities->find('list', ['limit' => 200]);
        $states = $this->Reservations->States->find('list', ['limit' => 200]);
        $countries = $this->Reservations->Countries->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'members', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['reservation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete_X($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Reservation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Reservation'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
