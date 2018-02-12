<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PropertyTypes Controller
 *
 * @property \App\Model\Table\PropertyTypesTable $PropertyTypes
 *
 * @method \App\Model\Entity\PropertyType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $propertyTypes = $this->paginate($this->PropertyTypes);

        $this->set(compact('propertyTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Property Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyType = $this->PropertyTypes->get($id, [
            'contain' => []
        ]);

        $this->set('propertyType', $propertyType);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propertyType = $this->PropertyTypes->newEntity();
        if ($this->request->is('post')) {
            $propertyType = $this->PropertyTypes->patchEntity($propertyType, $this->request->data);
            if ($this->PropertyTypes->save($propertyType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Property Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Property Type'));
            }
        }
        $this->set(compact('propertyType'));
        $this->set('_serialize', ['propertyType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertyType = $this->PropertyTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyType = $this->PropertyTypes->patchEntity($propertyType, $this->request->data);
            if ($this->PropertyTypes->save($propertyType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Property Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Property Type'));
            }
        }
        $this->set(compact('propertyType'));
        $this->set('_serialize', ['propertyType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyType = $this->PropertyTypes->get($id);
        if ($this->PropertyTypes->delete($propertyType)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Property Type'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Property Type'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
