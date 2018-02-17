<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Channels Controller
 *
 * @property \App\Model\Table\ChannelsTable $Channels
 *
 * @method \App\Model\Entity\Channel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChannelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $pass_cond = '';
        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'Channels.name like "%'.trim($this->request->query['search']).'%"';
        }

        $channels = $this->paginate($this->Channels,array('conditions'=>$pass_cond,'order'=>array('id desc'),'limit'=>2));

        $this->set(compact('channels'));
    }

    /**
     * View method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $channel = $this->Channels->get($id, [
            'contain' => []
        ]);

        $this->set('channel', $channel);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $channel = $this->Channels->newEntity();
        if ($this->request->is('post')) {
            $channel = $this->Channels->patchEntity($channel, $this->request->data);
            if ($this->Channels->save($channel)) {
                $this->Flash->success(__('The {0} has been saved.', 'Channel'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Channel'));
            }
        }
        $this->set(compact('channel'));
        $this->set('_serialize', ['channel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $channel = $this->Channels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $channel = $this->Channels->patchEntity($channel, $this->request->data);
            if ($this->Channels->save($channel)) {
                $this->Flash->success(__('The {0} has been saved.', 'Channel'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Channel'));
            }
        }
        $this->set(compact('channel'));
        $this->set('_serialize', ['channel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Channel id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $channel = $this->Channels->get($id);
        if ($this->Channels->delete($channel)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Channel'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Channel'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
