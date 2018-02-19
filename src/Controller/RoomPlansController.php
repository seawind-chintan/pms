<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoomPlans Controller
 *
 * @property \App\Model\Table\RoomPlansTable $RoomPlans
 *
 * @method \App\Model\Entity\RoomPlan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomPlansController extends AppController
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
            $roomPlanId = (int)$this->request->getParam('pass.0');
            $roomPlan = $this->RoomPlans->findById($roomPlanId)->first();
            if($roomPlan){
                return $roomPlan->user_id === $user['id'];
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
        $roomPlans = $this->paginate($this->RoomPlans, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('roomPlans'));
    }

    /**
     * View method
     *
     * @param string|null $id Room Plan id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomPlan = $this->RoomPlans->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('roomPlan', $roomPlan);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomPlan = $this->RoomPlans->newEntity();
        if ($this->request->is('post')) {
            $roomPlan = $this->RoomPlans->patchEntity($roomPlan, $this->request->data);
            $roomPlan->user_id = $this->Auth->user('id');
            if ($this->RoomPlans->save($roomPlan)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Plan'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Plan'));
            }
        }
        $users = $this->RoomPlans->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomPlan', 'users'));
        $this->set('_serialize', ['roomPlan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomPlan = $this->RoomPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomPlan = $this->RoomPlans->patchEntity($roomPlan, $this->request->data);
            $roomPlan->user_id = $this->Auth->user('id');
            if ($this->RoomPlans->save($roomPlan)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room Plan'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room Plan'));
            }
        }
        $users = $this->RoomPlans->Users->find('list', ['limit' => 200]);
        $this->set(compact('roomPlan', 'users'));
        $this->set('_serialize', ['roomPlan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomPlan = $this->RoomPlans->get($id);
        if ($this->RoomPlans->delete($roomPlan)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room Plan'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room Plan'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
