<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WaterparkCostumelockers Controller
 *
 * @property \App\Model\Table\WaterparkCostumelockersTable $WaterparkCostumelockers
 *
 * @method \App\Model\Entity\WaterparkCostumelocker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkCostumelockersController extends AppController
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
        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $priceId = (int)$this->request->getParam('pass.0');
            $waterparkCostumelocker = $this->WaterparkCostumelockers->findById($priceId)->first();
            
            return $waterparkCostumelocker->user_id === $user['id'];
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
            'contain' => ['Properties']
        ];
        $waterparkCostumelockers = $this->paginate($this->WaterparkCostumelockers, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkCostumelockers'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Costumelocker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkCostumelocker = $this->WaterparkCostumelockers->get($id, [
            'contain' => ['Properties']
        ]);

        $this->set('waterparkCostumelocker', $waterparkCostumelocker);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkCostumelocker = $this->WaterparkCostumelockers->newEntity();
        if ($this->request->is('post')) {
            $waterparkCostumelocker = $this->WaterparkCostumelockers->patchEntity($waterparkCostumelocker, $this->request->data);
            $waterparkCostumelocker->user_id = $this->Auth->user('id');
            if ($this->WaterparkCostumelockers->save($waterparkCostumelocker)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Costumelocker'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Costumelocker'));
            }
        }
        $properties = $this->WaterparkCostumelockers->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkCostumelocker', 'properties'));
        $this->set('_serialize', ['waterparkCostumelocker']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Costumelocker id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkCostumelocker = $this->WaterparkCostumelockers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkCostumelocker = $this->WaterparkCostumelockers->patchEntity($waterparkCostumelocker, $this->request->data);
            $waterparkCostumelocker->user_id = $this->Auth->user('id');
            if ($this->WaterparkCostumelockers->save($waterparkCostumelocker)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Costumelocker'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Costumelocker'));
            }
        }
        $properties = $this->WaterparkCostumelockers->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkCostumelocker', 'properties'));
        $this->set('_serialize', ['waterparkCostumelocker']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Costumelocker id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkCostumelocker = $this->WaterparkCostumelockers->get($id);
        if ($this->WaterparkCostumelockers->delete($waterparkCostumelocker)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Costumelocker'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Costumelocker'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
