<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
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
        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $roomId = (int)$this->request->getParam('pass.0');
            $room = $this->Rooms->findById($roomId)->first();

            return $room->user_id === $user['id'];
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
        $rooms = $this->paginate($this->Rooms);

        $this->set(compact('rooms'));
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => ['Users', 'RoomTypes']
        ]);

        $this->set('room', $room);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->data);
            $room->user_id = $this->Auth->user('id');
            $room->slug = Inflector::slug($room->name);
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room'));
            }
        }
        $users = $this->Rooms->Users->find('list', ['limit' => 200]);
        $roomtypes = $this->Rooms->RoomTypes->find('list', ['limit' => 200, 'user_id' => $this->Auth->user('id')]);
        $this->set(compact('room', 'users', 'roomtypes'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->data);
            $room->user_id = $this->Auth->user('id');
            $room->slug = Inflector::slug($room->name);
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room'));
            }
        }
        $users = $this->Rooms->Users->find('list', ['limit' => 200]);
        $roomtypes = $this->Rooms->RoomTypes->find('list', ['limit' => 200, 'user_id' => $this->Auth->user('id')]);
        $this->set(compact('room', 'users', 'roomtypes'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
