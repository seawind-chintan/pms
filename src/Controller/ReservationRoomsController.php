<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReservationRooms Controller
 *
 * @property \App\Model\Table\ReservationRoomsTable $ReservationRooms
 *
 * @method \App\Model\Entity\ReservationRoom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationRoomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Reservations', 'Rooms']
        ];
        $reservationRooms = $this->paginate($this->ReservationRooms);

        $this->set(compact('reservationRooms'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservationRoom = $this->ReservationRooms->get($id, [
            'contain' => ['Reservations', 'Rooms']
        ]);

        $this->set('reservationRoom', $reservationRoom);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservationRoom = $this->ReservationRooms->newEntity();
        if ($this->request->is('post')) {
            $reservationRoom = $this->ReservationRooms->patchEntity($reservationRoom, $this->request->data);
            if ($this->ReservationRooms->save($reservationRoom)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation Room'));
            }
        }
        $reservations = $this->ReservationRooms->Reservations->find('list', ['limit' => 200]);
        $rooms = $this->ReservationRooms->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('reservationRoom', 'reservations', 'rooms'));
        $this->set('_serialize', ['reservationRoom']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation Room id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservationRoom = $this->ReservationRooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservationRoom = $this->ReservationRooms->patchEntity($reservationRoom, $this->request->data);
            if ($this->ReservationRooms->save($reservationRoom)) {
                $this->Flash->success(__('The {0} has been saved.', 'Reservation Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Reservation Room'));
            }
        }
        $reservations = $this->ReservationRooms->Reservations->find('list', ['limit' => 200]);
        $rooms = $this->ReservationRooms->Rooms->find('list', ['limit' => 200]);
        $this->set(compact('reservationRoom', 'reservations', 'rooms'));
        $this->set('_serialize', ['reservationRoom']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation Room id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservationRoom = $this->ReservationRooms->get($id);
        if ($this->ReservationRooms->delete($reservationRoom)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Reservation Room'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Reservation Room'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
