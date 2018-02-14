<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $roomTypes = $this->paginate($this->RoomTypes);

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
            'contain' => []
        ]);

        $this->set('roomType', $roomType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomType = $this->RoomTypes->newEntity();
        if ($this->request->is('post')) {
            $roomType = $this->RoomTypes->patchEntity($roomType, $this->request->getData());
            if ($this->RoomTypes->save($roomType)) {
                $this->Flash->success(__('The room type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room type could not be saved. Please, try again.'));
        }
        $this->set(compact('roomType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomType = $this->RoomTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomType = $this->RoomTypes->patchEntity($roomType, $this->request->getData());
            if ($this->RoomTypes->save($roomType)) {
                $this->Flash->success(__('The room type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room type could not be saved. Please, try again.'));
        }
        $this->set(compact('roomType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomType = $this->RoomTypes->get($id);
        if ($this->RoomTypes->delete($roomType)) {
            $this->Flash->success(__('The room type has been deleted.'));
        } else {
            $this->Flash->error(__('The room type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
