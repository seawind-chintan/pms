<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * WaterparkSettings Controller
 *
 * @property \App\Model\Table\WaterparkSettingsTable $WaterparkSettings
 *
 * @method \App\Model\Entity\WaterparkSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkSettingsController extends AppController
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
            $settingId = (int)$this->request->getParam('pass.0');
            $waterparkSetting = $this->WaterparkSettings->findById($settingId)->first();
            
            return $waterparkSetting->user_id === $user['id'];
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
        $waterparkSettings = $this->paginate($this->WaterparkSettings, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkSettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Setting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkSetting = $this->WaterparkSettings->get($id, [
            'contain' => ['Users', 'Properties']
        ]);

        $this->set('waterparkSetting', $waterparkSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkSetting = $this->WaterparkSettings->newEntity();
        if ($this->request->is('post')) {
            $waterparkSetting = $this->WaterparkSettings->patchEntity($waterparkSetting, $this->request->data);
            $waterparkSetting->user_id = $this->Auth->user('id');
            $waterparkSetting->belt_code_prefix = strtoupper($this->request->data['belt_code_prefix']);
            if ($this->WaterparkSettings->save($waterparkSetting)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Setting'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Setting'));
            }
        }
        $users = $this->WaterparkSettings->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkSettings->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkSetting', 'users', 'properties'));
        $this->set('_serialize', ['waterparkSetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkSetting = $this->WaterparkSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkSetting = $this->WaterparkSettings->patchEntity($waterparkSetting, $this->request->data);
            $waterparkSetting->user_id = $this->Auth->user('id');
            $waterparkSetting->belt_code_prefix = strtoupper($this->request->data['belt_code_prefix']);
            if ($this->WaterparkSettings->save($waterparkSetting)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Setting'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Setting'));
            }
        }
        $users = $this->WaterparkSettings->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkSettings->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkSetting', 'users', 'properties'));
        $this->set('_serialize', ['waterparkSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkSetting = $this->WaterparkSettings->get($id);
        if ($this->WaterparkSettings->delete($waterparkSetting)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Setting'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Setting'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function getsettingsbyproperty(){

        if ($this->request->is('ajax'))
        {
            $postData = $this->request->data('myData');
            $property_id = $postData['property_id'];
            
            $settings = $this->WaterparkSettings->find('all', [
                'conditions' => ['property_id' => $property_id]
            ]);

            //pr(count($settings->toArray()));exit;
            if(count($settings->toArray()) > 0){
                $setting = $settings->first();

                $waterparkBeltsTable = TableRegistry::get('WaterparkBelts');
                $waterparkBelt = $waterparkBeltsTable->find('all', [
                    'conditions' => ['property_id' => $property_id]
                ]);

                if(!empty($waterparkBelt->last())){
                    $lastCodeArr = explode($setting->belt_code_prefix, $waterparkBelt->last()->code);
                    $lastWaterparkBelt = $lastCodeArr[1];
                } else {
                    $lastWaterparkBelt = 0;
                }

                //$lastWaterparkBelt = ((!empty($waterparkBelt->last())) ? explode($setting->belt_code_prefix, $waterparkBelt->last()->code[1]) : 0 );

                //pr($lastWaterparkBelt);exit;

                $newWaterparkBelt = (int) $lastWaterparkBelt + 1;

                $new_code_to_be = $setting->belt_code_prefix.$newWaterparkBelt;
                echo $new_code_to_be;exit;
                //echo json_encode($setting);exit;
            } else {
                echo 'false';exit;
            }
        }
    }
}
