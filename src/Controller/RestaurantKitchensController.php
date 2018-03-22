<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * RestaurantKitchens Controller
 *
 * @property \App\Model\Table\RestaurantKitchensTable $RestaurantKitchens
 *
 * @method \App\Model\Entity\RestaurantKitchen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantKitchensController extends AppController
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
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('list', array(
            'fields' => array('id', 'name'),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $club_admin_user_id), 'order' => 'id asc'
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
            $pass_cond = 'RestaurantKitchens.name like "%'.trim($this->request->query['search']).'%"';
        }
        $this->paginate = [
//            'contain' => ['ParentServices'],
            'conditions'=> [$pass_cond,'user_id'=>$club_admin_user_id],
            'order'=>array('RestaurantKitchens.id desc'),
//            'limit'=>2
        ];

        $restaurantKitchens = $this->paginate($this->RestaurantKitchens);

//        pr($restaurantKitchens);
//        exit;

        $this->set(compact('restaurantKitchens','property_data'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Kitchen id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurantKitchen = $this->RestaurantKitchens->get($id, [
            'contain' => []
        ]);

        $this->set('restaurantKitchen', $restaurantKitchen);
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

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $restaurantKitchen = $this->RestaurantKitchens->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['property_ids'] = implode(',', array_filter($this->request->data['property_ids']));
            $this->request->data['user_id'] = $club_admin_user_id;
//            pr($this->request);
//            exit;

            $restaurantKitchen = $this->RestaurantKitchens->patchEntity($restaurantKitchen, $this->request->data);
//            pr($restaurantKitchen);
//            exit;

            if ($this->RestaurantKitchens->save($restaurantKitchen)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Kitchen'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Kitchen'));
            }
        }




        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('all', array(
            'fields' => array('id', 'name','status','user','type' ),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $club_admin_user_id), 'order' => 'id asc'
        ));

        $property_data = $all_property_data->toArray();

//        pr($all_property_data);
//        pr($property_data);
//        exit;

        $this->set(compact('restaurantKitchen','property_data'));
        $this->set('_serialize', ['restaurantKitchen']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Kitchen id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $restaurantKitchen = $this->RestaurantKitchens->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

//            pr($this->request);
//            exit;
            $this->request->data['property_ids'] = implode(',', array_filter($this->request->data['property_ids']));

            $restaurantKitchen = $this->RestaurantKitchens->patchEntity($restaurantKitchen, $this->request->data);
            if ($this->RestaurantKitchens->save($restaurantKitchen)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Kitchen'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Kitchen'));
            }
        }


        $propertiesTable = TableRegistry::get('Properties');
        $all_property_data = $propertiesTable->find('all', array(
            'fields' => array('id', 'name','status','user','type' ),
            'conditions' => array('status' => 1, 'type'=>2, 'user'=> $club_admin_user_id), 'order' => 'id asc'
        ));

        $property_data = $all_property_data->toArray();

        $this->set(compact('restaurantKitchen','property_data'));
        $this->set('_serialize', ['restaurantKitchen']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Kitchen id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantKitchen = $this->RestaurantKitchens->get($id);
        if ($this->RestaurantKitchens->delete($restaurantKitchen)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Kitchen'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Kitchen'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
