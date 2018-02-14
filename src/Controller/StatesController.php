<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 *
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries']
        ];
        $states = $this->paginate($this->States);

        $this->set(compact('states'));
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => ['Countries', 'Cities']
        ]);

        $this->set('state', $state);
    }

    public function getcities($id = null)
    {
        if($this->request->is('ajax')) {
            //$this->layout = 'ajax';
            $this->viewBuilder()->setLayout('ajax');

            $state = $this->States->get($id, [
                'contain' => ['Countries', 'Cities']
            ]);

            $this->set('state', $state);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->States->newEntity();
        if ($this->request->is('post')) {
            $state = $this->States->patchEntity($state, $this->request->data);
            if ($this->States->save($state)) {
                $this->Flash->success(__('The {0} has been saved.', 'State'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'State'));
            }
        }
        $countries = $this->States->Countries->find('list', ['limit' => 200]);
        $this->set(compact('state', 'countries'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->data);
            if ($this->States->save($state)) {
                $this->Flash->success(__('The {0} has been saved.', 'State'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'State'));
            }
        }
        $countries = $this->States->Countries->find('list', ['limit' => 200]);
        $this->set(compact('state', 'countries'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The {0} has been deleted.', 'State'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'State'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
