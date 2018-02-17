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

        $members = $this->Reservations->Members->find('list', ['limit' => 200]);
        $membertypes = $this->getMemberTypes();
        $cities = $this->Reservations->Cities->find('list', ['limit' => 200]);
        $states = $this->Reservations->States->find('list', ['limit' => 200]);
        $roomsTable = TableRegistry::get('Rooms');
        $rooms = $roomsTable->find('all', [
            'conditions' => ['Rooms.status' => 1]
        ]);
        $totalRooms = count($rooms->toArray());
        $countries = $this->Reservations->Countries->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'members', 'membertypes', 'reservationtypes', 'cities', 'states', 'countries', 'totalRooms', 'properties'));

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
        //pr($wizardData);exit;
        $postData = array_merge($wizardData['step1'], $wizardData['step2'], $wizardData['step3'], $wizardData['step4']);
        pr($wizardData['step3']);
        pr($postData);exit;

        $reservation = $this->Reservations->newEntity();
        $reservation = $this->Reservations->patchEntity($reservation, $postData);
        if ($this->Reservations->save($reservation)) {
            $this->Flash->success(__('The {0} has been saved.', 'Reservation'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation'));
        }

        /*$this->Client->save($account['Client'], false, array('first_name', 'last_name', 'phone'));
        $this->User->save($account['User'], false, array('email', 'password'));*/
        
        //... etc ...
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Cities', 'States', 'Countries']
        ];
        $reservations = $this->paginate($this->Reservations);

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
    public function add()
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
    public function edit($id = null)
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
    public function delete($id = null)
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
