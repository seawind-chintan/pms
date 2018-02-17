<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProfileSettings Controller
 *
 * @property \App\Model\Table\ProfileSettingsTable $ProfileSettings
 *
 * @method \App\Model\Entity\ProfileSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileSettingsController extends AppController
{
    function setting()
    {
        //For skin color
        $skin_array = $this->skin_array();
        $this->set('skin_array',$skin_array);

        $profile_data = $this->ProfileSettings->find('all', [
            'contain' => [],
            'conditions'=>array('user_id'=>$this->Auth->User('id'))
        ]);

        $profile_array = $profile_data->toArray();

//        pr($profile_data);
//        pr($profile_data->toArray());
//        exit;

        if(empty($profile_array))
        {
            $profileSetting = $this->ProfileSettings->newEntity();
        }
        else
        {
            $profileSetting = $profile_data->first();
        }


        if ($this->request->is(['patch', 'post', 'put'])) {

//            pr($this->request->data);
//            exit;
            $this->request->data['user_id'] = $this->Auth->User('id');

            $profileSetting = $this->ProfileSettings->patchEntity($profileSetting, $this->request->data);
            //if(isset($this->request->data['id']) && $this->request->data['id']!=''){$profileSetting->id = $this->request->data['id'];}

//            pr($profileSetting);
//            exit;

            if ($this->ProfileSettings->save($profileSetting)) {
                $this->Flash->success(__('The {0} has been saved.', 'Profile Setting'));
                return $this->redirect(['action' => 'setting']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Profile Setting'));
            }
        }



        $this->set(compact('profileSetting'));
        $this->set('_serialize', ['profileSetting']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $profileSettings = $this->paginate($this->ProfileSettings);

        $this->set(compact('profileSettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile Setting id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profileSetting = $this->ProfileSettings->get($id, [
            'contain' => []
        ]);

        $this->set('profileSetting', $profileSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profileSetting = $this->ProfileSettings->newEntity();
        if ($this->request->is('post')) {
            $profileSetting = $this->ProfileSettings->patchEntity($profileSetting, $this->request->data);
            if ($this->ProfileSettings->save($profileSetting)) {
                $this->Flash->success(__('The {0} has been saved.', 'Profile Setting'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Profile Setting'));
            }
        }
        $this->set(compact('profileSetting'));
        $this->set('_serialize', ['profileSetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profileSetting = $this->ProfileSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profileSetting = $this->ProfileSettings->patchEntity($profileSetting, $this->request->data);
            if ($this->ProfileSettings->save($profileSetting)) {
                $this->Flash->success(__('The {0} has been saved.', 'Profile Setting'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Profile Setting'));
            }
        }
        $this->set(compact('profileSetting'));
        $this->set('_serialize', ['profileSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profileSetting = $this->ProfileSettings->get($id);
        if ($this->ProfileSettings->delete($profileSetting)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Profile Setting'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Profile Setting'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
