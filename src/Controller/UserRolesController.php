<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserRoles Controller
 *
 * @property \App\Model\Table\UserRolesTable $UserRoles
 *
 * @method \App\Model\Entity\UserRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserRolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $userRoles = $this->paginate($this->UserRoles);

        $this->set(compact('userRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => []
        ]);

        $this->set('userRole', $userRole);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userRole = $this->UserRoles->newEntity();
        if ($this->request->is('post')) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Role'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Role'));
            }
        }
        $this->set(compact('userRole'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Role'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Role'));
            }
        }
        $this->set(compact('userRole'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRole = $this->UserRoles->get($id);
        if ($this->UserRoles->delete($userRole)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User Role'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User Role'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
