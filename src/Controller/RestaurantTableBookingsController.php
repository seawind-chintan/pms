<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * RestaurantTableBookings Controller
 *
 * @property \App\Model\Table\RestaurantTableBookingsTable $RestaurantTableBookings
 *
 * @method \App\Model\Entity\RestaurantTableBooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RestaurantTableBookingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $propertiesTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $propertiesTable->find('all', [
                                    'fields' => array('id','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

        $table_array = array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
            }
        }

//        pr($table_array);
//        pr($restaurant_tbl_ar);
//        exit;

        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'RestaurantTableBookings.name like "%'.trim($this->request->query['search']).'%"';
        }
        $this->paginate = [
            'conditions'=> array('property_id'=>$select_restaurant_id, $pass_cond),
            'order'=>array('RestaurantTableBookings.id desc'),
//            'limit'=>2
        ];

        $restaurantTableBookings = $this->paginate($this->RestaurantTableBookings);
//        pr($restaurantTableBookings);
//        exit;

        $this->set(compact('restaurantTableBookings','table_array'));
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant Table Booking id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

//        pr($session->read());
//        exit;

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

//        pr($restaurantTableBooking);
//        exit;

//        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
//        $properties = $this->RestaurantMenuTypes->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $restaurantTableBooking = $this->RestaurantTableBookings->get($id, [
            'contain' => []
        ]);

        $restaurantTables = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $restaurantTables->find('all', [
                                    'fields' => array('id','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id,'id in'=>explode(',',$restaurantTableBooking->restaurant_table_ids)],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

//        pr($restaurant_tbl_data );
//        pr($restaurant_tbl_ar );
//        exit;

        $table_array = array();
        $select_table_data = '';
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[] = $restaurant_tbl_ar[$i]->table_no;
            }
            $select_table_data = implode(', ',$table_array);
        }
        $this->set(compact('properties','select_table_data'));
        $this->set('restaurantTableBooking', $restaurantTableBooking);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $restaurantTableBooking = $this->RestaurantTableBookings->newEntity();

//        pr($restaurantTableBooking);
//        exit;

        if ($this->request->is('post')) {

            $this->request->data['restaurant_table_ids'] = implode(',',$this->request->data['restaurant_table_ids']);
            $this->request->data['booking_date'] = $this->setdateformat($this->request->data['booking_date'],'Y-m-d');
            $this->request->data['booking_time'] = $this->request->data['booking_time']['hour'].':'. $this->request->data['booking_time']['minute'];
            $this->request->data['advanced_payment'] =0;

            $restaurantTableBooking = $this->RestaurantTableBookings->patchEntity($restaurantTableBooking, $this->request->data);

//            pr($restaurantTableBooking);
//            pr($this->request);
//            exit;

            if ($this->RestaurantTableBookings->save($restaurantTableBooking)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Table Booking'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Table Booking'));
            }
        }

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->RestaurantTableBookings->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $propertiesTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $propertiesTable->find('all', [
                                    'fields' => array('id','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id,'booking_status'=>1],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

        $table_array = array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
            }
        }
//        pr($table_array);
//        pr($restaurant_tbl_ar);
//        exit;

        $this->set(compact('restaurantTableBooking', 'properties','table_array'));
        $this->set('_serialize', ['restaurantTableBooking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant Table Booking id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $propertiesTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $propertiesTable->find('all', [
                                    'fields' => array('id','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

        $table_array = array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
//                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->id;
            }
        }

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->RestaurantTableBookings->Properties->find('list', ['conditions'=>[$pass_cond]]);
        $this->set(compact('properties','table_array'));

        $restaurantTableBooking = $this->RestaurantTableBookings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurantTableBooking = $this->RestaurantTableBookings->patchEntity($restaurantTableBooking, $this->request->data);
            if ($this->RestaurantTableBookings->save($restaurantTableBooking)) {
                $this->Flash->success(__('The {0} has been saved.', 'Restaurant Table Booking'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Restaurant Table Booking'));
            }
        }
        $this->set(compact('restaurantTableBooking'));
        $this->set('_serialize', ['restaurantTableBooking']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant Table Booking id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurantTableBooking = $this->RestaurantTableBookings->get($id);
        if ($this->RestaurantTableBookings->delete($restaurantTableBooking)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Restaurant Table Booking'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Restaurant Table Booking'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
