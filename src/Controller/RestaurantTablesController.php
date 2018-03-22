<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * RestaurantTables Controller
 *
 * @property \App\Model\Table\RestaurantTablesTable $RestaurantTables
 *
 * @method \App\Model\Entity\RestaurantTable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantTablesController extends AppController
{
    function defaultRestaurant()
    {
        $session = $this->request->session();

//        pr($session->read());
//        exit;

        //echo $this->Auth->User('parent');
        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $properties = $this->RestaurantTables->Properties->find('list', ['conditions'=>['type' => 2,'user'=>$club_admin_user_id], 'limit' => 200]);
        $property_array = $properties->toArray();

//        pr($property_array);
//        exit;

        $restaurantTable = $this->RestaurantTables->newEntity();

        if ($this->request->is('post')) {

            if(isset($this->request->data['property_id']) && $this->request->data['property_id']!='')
            {
                $session = $this->request->session();
                $session->write('default_restaurant_id', $this->request->data['property_id']);
                $session->write('default_restaurant_name', $property_array[$this->request->data['property_id']]);
                $this->Flash->success(__('The {0} has been saved.', 'Default Restaurant'));
                return $this->redirect(['action' => 'defaultRestaurant']);
            }
            else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Table'));
            }

//            pr($this->request);
//            exit;
        }

        $this->set(compact('restaurantTable', 'properties'));
        $this->set('_serialize', ['restaurantTable']);
    }

    function displayRestaurantTable()
    {
         //For display status
        $restaurant_status_array = $this->restaurant_status_array();
        $status_options = $this->status_array();
        $this->set(compact('restaurant_status_array','status_options'));

        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $restaurant_tbl_data = $this->RestaurantTables->find('all', [
//                                    'fields' => array('RestaurantTables.*','Kots.id'),
                                    'fields' => array('RestaurantTables.property_id', 'RestaurantTables.code', 'RestaurantTables.capacity', 'RestaurantTables.booking_status', 'Kots.id', 'Kots.kot_status'),
                                    'conditions'=>['RestaurantTables.property_id' => $select_restaurant_id],
                                    'order'=>['RestaurantTables.id asc'],

                                ])
                                ->join([
                                    'kots' => [
                                        'table' => 'Kots',
                                        'type' => 'left',
                                        'conditions' => '(Kots.restaurant_table_id = RestaurantTables.id and Kots.kot_status=0)'
                                    ]
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();
        $this->set(compact('restaurant_tbl_ar'));

//        $this->set(compact('restaurantTable', 'properties'));
//        $this->set('_serialize', ['restaurantTable']);

//        pr($session->read());
//            pr($restaurant_tbl_ar);
//            exit;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //For display status
        $restaurant_status_array = $this->restaurant_status_array();
        $status_options = $this->status_array();
        $this->set(compact('restaurant_status_array','status_options'));

        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $this->paginate = [
            'contain' => ['Properties'],
            'conditions'=>['property_id' =>$select_restaurant_id],
            'order'=>['RestaurantTables.id desc']
        ];
        $restaurantTables = $this->paginate($this->RestaurantTables);

        $this->set(compact('restaurantTables','restaurant_status_array','status_options'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Table id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurantTable = $this->RestaurantTables->get($id, [
            'contain' => ['Properties']
        ]);

        $this->set('restaurantTable', $restaurantTable);
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
//        $select_property_name = $session->read('default_restaurant_name');
//        $this->set(compact('select

        $restaurantTable = $this->RestaurantTables->newEntity();
        if ($this->request->is('post')) {
//            exit;

            //`property_id`, `code`, `capacity`, `booking_status`

            $restaurant_ar = array();

            $tbl_data = $this->request->data['property_id'];
            $tbl_capacity = $this->request->data['capacity'];

            $start_tbl_data = $this->request->data['start_table_no'];
            $total_add_tbl_data = $this->request->data['total_no_of_table'];

            if($total_add_tbl_data>0)
            {
                $j=0;
                for($i=$start_tbl_data;$i<($start_tbl_data+$total_add_tbl_data);$i++)
                {
                    $restaurantTable = $this->RestaurantTables->newEntity();

                    $restaurant_ar['code'] = $i;
                    $restaurant_ar['property_id'] = $tbl_data;
                    $restaurant_ar['capacity'] = $tbl_capacity;
                    $restaurant_ar['booking_status'] = 1;   //0=>'Occupied',1=>'Not-Occupied',3=>'Booked'
                    $restaurant_ar['status'] = 1;   //0:Draft;1:Published;2:Deleted;
                    $restaurant_ar['created'] = date('Y-m-d H:i:s');
                    $restaurant_ar['modified'] = date('Y-m-d H:i:s');
//                    pr($restaurant_ar);

                    $restaurantTable = $this->RestaurantTables->patchEntity($restaurantTable, $restaurant_ar);
//                    exit;
                    $this->RestaurantTables->save($restaurantTable);
                    $j++;
//                    exit;
                }
            }
//            pr($this->request);
//            exit;



//            $restaurantTable = $this->RestaurantTables->patchEntity($restaurantTable, $this->request->data);
            if ($j==$total_add_tbl_data) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Table'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Table'));
            }
        }

        $get_last_property_tbl = $this->RestaurantTables->find('all',[
            'fields' => array('id','code','capacity'),
            'conditions'=>['property_id' =>$select_restaurant_id],
            'order'=>array('code desc')
        ]);

        $last_tbl_dtl= $get_last_property_tbl->first()->toArray();
//        pr($last_tbl_dtl);
//        exit;

        if(!empty($last_tbl_dtl))
            $last_table_no = $last_tbl_dtl['code'] + 1;
        else
            $last_table_no = 1;

//        echo '<br>last_table_no - '.$last_table_no;
//        pr($last_max_tbl_dtl);
//        exit;

        $this->set(compact('restaurantTable','last_table_no'));
        $this->set('_serialize', ['restaurantTable']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Table id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For display status
        $restaurant_status_array = $this->restaurant_status_array();
        $status_options = $this->status_array();
        $this->set(compact('restaurant_status_array','status_options'));

        $restaurantTable = $this->RestaurantTables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

//            pr($this->request->data);
//            exit;

            $restaurantTable = $this->RestaurantTables->patchEntity($restaurantTable, $this->request->data);
            if ($this->RestaurantTables->save($restaurantTable)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Table'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Table'));
            }
        }
        //$properties = $this->RestaurantTables->Properties->find('list', ['limit' => 200]);
//        $this->set(compact('restaurantTable', 'properties'));
        $this->set(compact('restaurantTable'));
        $this->set('_serialize', ['restaurantTable']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Table id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantTable = $this->RestaurantTables->get($id);
        if ($this->RestaurantTables->delete($restaurantTable)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Table'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Table'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
