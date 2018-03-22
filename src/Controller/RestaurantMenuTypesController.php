<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RestaurantMenuTypes Controller
 *
 * @property \App\Model\Table\RestaurantMenuTypesTable $RestaurantMenuTypes
 *
 * @method \App\Model\Entity\RestaurantMenuType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantMenuTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');
//        pr($session->read());
//        exit;
        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'RestaurantMenuTypes.name like "%'.trim($this->request->query['search']).'%"';
        }
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        //echo $club_admin_user_id;

        $this->paginate = [
            'conditions'=> [$pass_cond,'RestaurantMenuTypes.user_id'=>$club_admin_user_id],
            'order'=>array('RestaurantMenuTypes.id desc'),
//            'limit'=>2
        ];

        $restaurantMenuTypes = $this->paginate($this->RestaurantMenuTypes);
        $this->set(compact('restaurantMenuTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Menu Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurantMenuType = $this->RestaurantMenuTypes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('restaurantMenuType', $restaurantMenuType);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $restaurantMenuType = $this->RestaurantMenuTypes->newEntity();

        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $club_admin_user_id;
            $restaurantMenuType = $this->RestaurantMenuTypes->patchEntity($restaurantMenuType, $this->request->data);

//            pr($restaurantMenuType);
//            exit;

            if ($this->RestaurantMenuTypes->save($restaurantMenuType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Menu Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Menu Type'));
            }
        }
        $this->set(compact('restaurantMenuType'));
        $this->set('_serialize', ['restaurantMenuType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Menu Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $restaurantMenuType = $this->RestaurantMenuTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['user_id'] = $club_admin_user_id;
            $restaurantMenuType = $this->RestaurantMenuTypes->patchEntity($restaurantMenuType, $this->request->data);
//            pr($restaurantMenuType);
//            exit;

            if ($this->RestaurantMenuTypes->save($restaurantMenuType)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Menu Type'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Menu Type'));
            }
        }

//        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
//        $properties = $this->RestaurantMenuTypes->Properties->find('list', ['conditions'=>[$pass_cond]]);
//        $this->set(compact('restaurantMenuType', 'properties'));
        
        $this->set(compact('restaurantMenuType'));
        $this->set('_serialize', ['restaurantMenuType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Menu Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantMenuType = $this->RestaurantMenuTypes->get($id);
        if ($this->RestaurantMenuTypes->delete($restaurantMenuType)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Menu Type'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Menu Type'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
