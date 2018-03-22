<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * RestaurantWaiters Controller
 *
 * @property \App\Model\Table\RestaurantWaitersTable $RestaurantWaiters
 *
 * @method \App\Model\Entity\RestaurantWaiter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantWaitersController extends AppController
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

        //echo 'auth_id '.
        $login_id = $this->Auth->User('id');

        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('list', array(
            'fields' => array('id', 'name'),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $login_id), 'order' => 'id asc'
        ));

        $property_data = $all_property_data->toArray();
//        pr($property_data);
//        exit;

        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'RestaurantWaiters.name like "%'.trim($this->request->query['search']).'%"';
        }
        $this->paginate = [
//            'contain' => ['ParentServices'],
            'conditions'=> $pass_cond,
            'order'=>array('RestaurantWaiters.id desc'),
            //'limit'=>2
        ];

        $restaurantWaiters = $this->paginate($this->RestaurantWaiters);
        $this->set(compact('restaurantWaiters','property_data'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Waiter id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurantWaiter = $this->RestaurantWaiters->get($id, [
            'contain' => []
        ]);

        $this->set('restaurantWaiter', $restaurantWaiter);
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

        $restaurantWaiter = $this->RestaurantWaiters->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['property_ids'] = implode(',', array_filter($this->request->data['property_ids']));
//            pr($this->request);
//            exit;

            $restaurantWaiter = $this->RestaurantWaiters->patchEntity($restaurantWaiter, $this->request->data);
            if ($this->RestaurantWaiters->save($restaurantWaiter)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Waiter'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Waiter'));
            }
        }

        //echo 'auth_id '.
        $login_id = $this->Auth->User('id');


        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('all', array(
            'fields' => array('id', 'name','status','user','type' ),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $login_id), 'order' => 'id asc'
        ));

        $property_data = $all_property_data->toArray();

        $this->set(compact('restaurantWaiter','property_data'));
        $this->set('_serialize', ['restaurantWaiter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Waiter id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         //echo 'auth_id '.
        $login_id = $this->Auth->User('id');

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);


        $restaurantWaiter = $this->RestaurantWaiters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['property_ids'] = implode(',', array_filter($this->request->data['property_ids']));

            $restaurantWaiter = $this->RestaurantWaiters->patchEntity($restaurantWaiter, $this->request->data);
            if ($this->RestaurantWaiters->save($restaurantWaiter)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Waiter'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Waiter'));
            }
        }

        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('all', array(
            'fields' => array('id', 'name','status','user','type' ),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $login_id), 'order' => 'id asc'
        ));

        $property_data = $all_property_data->toArray();

        $this->set(compact('restaurantWaiter','property_data'));
        $this->set('_serialize', ['restaurantWaiter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Waiter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantWaiter = $this->RestaurantWaiters->get($id);
        if ($this->RestaurantWaiters->delete($restaurantWaiter)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Waiter'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Waiter'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
