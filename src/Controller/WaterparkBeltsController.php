<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * WaterparkBelts Controller
 *
 * @property \App\Model\Table\WaterparkBeltsTable $WaterparkBelts
 *
 * @method \App\Model\Entity\WaterparkBelt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkBeltsController extends AppController
{
    public function isAuthorized($user)
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            $beltId = (int)$this->request->getParam('pass.0');
            $WaterparkBelt = $this->WaterparkBelts->findById($beltId)->first();
            return $WaterparkBelt->user_id === $user['id'];
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
            'contain' => ['Users', 'Properties']
        ];
        $waterparkBelts = $this->paginate($this->WaterparkBelts, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkBelts'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Belt id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkBelt = $this->WaterparkBelts->get($id, [
            'contain' => ['Users', 'Properties']
        ]);

        $this->set('waterparkBelt', $waterparkBelt);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkBelt = $this->WaterparkBelts->newEntity();

        if ($this->request->is('post')) {
            $waterparkBelt = $this->WaterparkBelts->patchEntity($waterparkBelt, $this->request->data);
            $waterparkBelt->user_id = $this->Auth->user('id');
            if ($this->WaterparkBelts->save($waterparkBelt)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Belt'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Belt'));
            }
        }
        $users = $this->WaterparkBelts->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkBelts->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkBelt', 'users', 'properties'));
        $this->set('_serialize', ['waterparkBelt']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Belt id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkBelt = $this->WaterparkBelts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkBelt = $this->WaterparkBelts->patchEntity($waterparkBelt, $this->request->data);
            $waterparkBelt->user_id = $this->Auth->user('id');
            if ($this->WaterparkBelts->save($waterparkBelt)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Belt'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Belt'));
            }
        }
        $users = $this->WaterparkBelts->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkBelts->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkBelt', 'users', 'properties'));
        $this->set('_serialize', ['waterparkBelt']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Belt id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkBelt = $this->WaterparkBelts->get($id);
        if ($this->WaterparkBelts->delete($waterparkBelt)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Belt'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Belt'));
        }
        return $this->redirect(['action' => 'index']);
    }

    function beltcode(){
        $waterparkBeltsResult = $this->WaterparkBelts->find('all')->all();
        $waterparkBeltLast = (!empty($waterparkBeltsResult->last()) ? $waterparkBeltsResult->last() : 0 );

        $waterparkSettingsTable = TableRegistry::get('WaterparkSettings');
        $waterparkSetting = $waterparkSettingsTable->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id'), 'property_id' => $room->property_id, 'RoomRates.room_type_id' => $room->type, 'RoomRates.room_occupancy_id' => $room->room_occupancy ]
        ]);
    }
}
