<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 *
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['States']
        ];
        $cities = $this->paginate($this->Cities);

        $this->set(compact('cities'));
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => ['States']
        ]);

        $this->set('city', $city);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The {0} has been saved.', 'City'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'City'));
            }
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
        $this->set('_serialize', ['city']);
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The {0} has been saved.', 'City'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'City'));
            }
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
        $this->set('_serialize', ['city']);
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The {0} has been deleted.', 'City'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'City'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
