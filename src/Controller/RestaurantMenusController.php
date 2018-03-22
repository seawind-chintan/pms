<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RestaurantMenus Controller
 *
 * @property \App\Model\Table\RestaurantMenusTable $RestaurantMenus
 *
 * @method \App\Model\Entity\RestaurantMenu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantMenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
//        pr($this->request->query['page']);
//        exit;
        $status_options = $this->status_array();
        $menu_category_array = $this->restaurant_menu_category_array();
        $this->set(compact('status_options','menu_category_array'));

        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');
//        pr($session->read());
//        exit;

        $pass_cond = '';
        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'RestaurantMenus.name like "%'.trim($this->request->query['search']).'%"';
        }

        $this->paginate = [
            'contain' => ['Properties', 'RestaurantKitchens', 'RestaurantMenuTypes'],
            'conditions'=> [$pass_cond, 'RestaurantMenus.property_id'=>$select_restaurant_id],
            'order'=>array('RestaurantMenus.id desc'),
//            'limit'=>2
        ];

        $restaurantMenus = $this->paginate($this->RestaurantMenus);
        $this->set(compact('restaurantMenus','limit'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Menu id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $status_options = $this->status_array();
        $menu_category_array = $this->restaurant_menu_category_array();
        $this->set(compact('status_options','menu_category_array'));

        $restaurantMenu = $this->RestaurantMenus->get($id, [
            'contain' => ['Properties', 'RestaurantKitchens', 'RestaurantMenuTypes']
        ]);

        $this->set('restaurantMenu', $restaurantMenu);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $status_options = $this->status_array();
        $menu_category_array = $this->restaurant_menu_category_array();
        $this->set(compact('status_options','menu_category_array'));

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $restaurantMenu = $this->RestaurantMenus->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['discountable'] = 'No';
            $this->request->data['is_home_delivery'] = 'No';
//            pr($this->request);
//            exit;

            $restaurantMenu = $this->RestaurantMenus->patchEntity($restaurantMenu, $this->request->data);
//            pr($restaurantMenu);
//            exit;

            if ($this->RestaurantMenus->save($restaurantMenu)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Menu'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Menu'));
            }
        }

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->RestaurantMenus->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $pass_kit_cond = "";
        $restaurantKitchens = $this->RestaurantMenus->RestaurantKitchens->find('list', ['conditions'=>['user_id'=>$club_admin_user_id,'FIND_IN_SET('. $select_restaurant_id .',property_ids)'],'limit' => 200]);
        //pr($restaurantKitchens);

        $restaurantMenuTypes = $this->RestaurantMenus->RestaurantMenuTypes->find('list', ['conditions'=>['user_id'=>$club_admin_user_id],'limit' => 200]);

        $this->set(compact('restaurantMenu', 'properties', 'restaurantKitchens', 'restaurantMenuTypes'));
        $this->set('_serialize', ['restaurantMenu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $status_options = $this->status_array();
        $menu_category_array = $this->restaurant_menu_category_array();
        $this->set(compact('status_options','menu_category_array'));

        $restaurantMenu = $this->RestaurantMenus->get($id, [
            'contain' => []
        ]);

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['discountable'] = 'No';
            $this->request->data['is_home_delivery'] = 'No';
            $restaurantMenu = $this->RestaurantMenus->patchEntity($restaurantMenu, $this->request->data);
            if ($this->RestaurantMenus->save($restaurantMenu)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Menu'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Menu'));
            }
        }
        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->RestaurantMenus->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $restaurantKitchens = $this->RestaurantMenus->RestaurantKitchens->find('list', ['conditions'=>['user_id'=>$club_admin_user_id],'limit' => 200]);
        $restaurantMenuTypes = $this->RestaurantMenus->RestaurantMenuTypes->find('list', ['conditions'=>['user_id'=>$club_admin_user_id],'limit' => 200]);

        $this->set(compact('restaurantMenu', 'properties', 'restaurantKitchens', 'restaurantMenuTypes'));
        $this->set('_serialize', ['restaurantMenu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantMenu = $this->RestaurantMenus->get($id);
        if ($this->RestaurantMenus->delete($restaurantMenu)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Menu'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Menu'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
