<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;

/**
 * RoomTypes Controller
 *
 * @property \App\Model\Table\RoomTypesTable $RoomTypes
 *
 * @method \App\Model\Entity\RoomType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomTypesController extends AppController
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
        $roomTypes = $this->paginate($this->RoomTypes, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('roomTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Room Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomType = $this->RoomTypes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('roomType', $roomType);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomType = $this->RoomTypes->newEntity();
        if ($this->request->is('post')) {
            $roomType = $this->RoomTypes->patchEntity($roomType, $this->request->data);
            $roomType->user_id = $this->Auth->user('id');
            $roomType->slug = Inflector::slug($roomType->name);
            if ($this->RoomTypes->save($roomType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Type'));
            }
        }
        $users = $this->RoomTypes->Users->find('list', ['limit' => 200]);
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);
        $this->set(compact('roomType', 'users'));
        $this->set('_serialize', ['roomType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomType = $this->RoomTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomType = $this->RoomTypes->patchEntity($roomType, $this->request->data);
            $roomType->user_id = $this->Auth->user('id');
            $roomType->slug = Inflector::slug($roomType->name);
            if ($this->RoomTypes->save($roomType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Type'));
            }
        }
        $users = $this->RoomTypes->Users->find('list', ['limit' => 200]);
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);
        $this->set(compact('roomType', 'users'));
        $this->set('_serialize', ['roomType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomType = $this->RoomTypes->get($id);
        if ($this->RoomTypes->delete($roomType)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room Type'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room Type'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function getpricebytype($id){

        $roomType = $this->RoomTypes->get($id);
        //pr($roomType);exit;
        echo $roomType->price;exit;
        $this->set(compact('roomTypes'));
    }
}
