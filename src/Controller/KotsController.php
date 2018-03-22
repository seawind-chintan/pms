<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Kots Controller
 *
 * @property \App\Model\Table\KotsTable $Kots
 *
 * @method \App\Model\Entity\Kot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KotsController extends AppController {


    function menuList($kitchenid = null)
    {
    //        echo "vivek";
    //        exit;

        if($this->request->is('ajax'))
        {
            //For get default property id
            $session = $this->request->session();
            $select_restaurant_id = $session->read('default_restaurant_id');

            $restaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $menu_list_data = $restaurantMenusTable->find('list', [
                'conditions'=>['property_id'=> $select_restaurant_id,'restaurant_kitchen_id'=>$kitchenid,'status'=>1],   // 'property_ids in' => $select_restaurant_id
                'order'=>array('id asc'),
                'limit' => 200
            ])->toArray();

            $this->set('menulist',$menu_list_data);

//            pr($menu_list_data);
//            exit;
        }
    }

    function ajaxMenuPrice($item_id)
    {
        if($this->request->is('ajax'))
        {
             //For get default property id
            $session = $this->request->session();
            $select_restaurant_id = $session->read('default_restaurant_id');

            $restaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $menu_list_data = $restaurantMenusTable->find('all', [
                'fields' => array('id','restaurant_kitchen_id','price','status'),
                'conditions'=>['property_id'=> $select_restaurant_id,'status'=>1,'id'=>$item_id],   // 'property_ids in' => $select_restaurant_id
                'order'=>array('id asc')
            ])->first();

//            pr(json_encode($menu_list_data, JSON_PRETTY_PRINT));
//            exit;

            $this->set('menulist',json_encode($menu_list_data, JSON_PRETTY_PRINT));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

//        $pass_cond = "kot_status in (0,1)";
        $pass_cond = "kot_status in (1)";

        $this->paginate = [
            'contain' => ['Properties', 'RestaurantTables'],
            'conditions'=>[$pass_cond],
        ];

        $kots = $this->paginate($this->Kots);

//        pr($kots);
//        exit;

        $this->set(compact('kots'));
    }


    /**
     * View method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $kot = $this->Kots->get($id, [
            'contain' => ['Properties', 'RestaurantTables', 'KotItems']
        ]);

        $this->set('kot', $kot);
    }

    function changeTable()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');$pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'property_id='.$select_restaurant_id:'';

        $non_occupied_table_array = $occupied_table_array = array();
        $kot_list = $this->Kots->find('all', [
            'fields' => ['id','restaurant_table_id','restaurant_table_code'],
            'conditions'=>[$pass_cond],
            'group'=>'restaurant_table_id'
            ])->toArray();

        //Get occupied table list and non occupied table list
        $restaurantTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $restaurantTable->find('all', [
                                    'fields' => array('id','code','table_no'=>'concat(code,"(",capacity,")")','booking_status'),
                                    'conditions'=>['property_id' => $select_restaurant_id],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();


        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                if($restaurant_tbl_ar[$i]->booking_status==1)
                {
                    $non_occupied_table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
                    $table_code_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->code;
                }
                else
                    $occupied_table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
            }
        }

//        pr($table_code_array);
//        pr($restaurant_tbl_ar);
//        pr($non_occupied_table_array);
//        pr($occupied_table_array);
//        pr($table_array);
//        exit;

        $kot = $this->Kots->newEntity();

        $error_array = array();
        if ($this->request->is('post')) {

            if(isset($this->request->data['occupied_id']) && trim($this->request->data['occupied_id'])=='')
                $error_array ['error_occupied'] = 'Please select Occupied Table';
            if(isset($this->request->data['non_occupied_id']) && trim($this->request->data['non_occupied_id'])=='')
                $error_array ['error_non_occupied'] = 'Please select Vacant Tables';

//            pr($error_array);
//            exit;

            if(empty($error_array))
            {
                $tbl_id = $this->request->data['occupied_id'];
                $update_kots['restaurant_table_id'] = $this->request->data['non_occupied_id'];
                $update_kots['restaurant_table_code'] = $table_code_array[$this->request->data['non_occupied_id']];

                //Update kot entry based on table
                $update_kot = $this->Kots->updateAll($update_kots, array('restaurant_table_id'=>$tbl_id));

                //Update data in to kot items
                $KotItemsTable = TableRegistry::get('KotItems');
                $kots = $KotItemsTable->updateAll(array('restaurant_table_id'=>$this->request->data['non_occupied_id']), array('restaurant_table_id'=>$tbl_id));

                //Free old table
                $old_red_table_id = $restaurantTable->updateAll(array('booking_status'=>1), array('id'=>$this->request->data['occupied_id']));

                //Assing table to new id
                $new_red_table_id = $restaurantTable->updateAll(array('booking_status'=>0), array('id'=>$this->request->data['non_occupied_id']));

                if ($update_kot){
                    $this->Flash->success(__('The {0} has been updated.', 'Restaurant Table'));
                    return $this->redirect([ "controller" => "restaurant-tables", 'action' => 'displayRestaurantTable']);
                }
                else {
                    $this->Flash->error(__('The {0} could not be updated. Please, try again.', 'Restaurant Table'));
                }
            }
        }

        $this->set(compact('non_occupied_table_array','occupied_table_array','error_array'));
        $this->set('kot', $kot);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {

        //$this->layout = 'print';

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->Kots->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $propertiesTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $propertiesTable->find('all', [
                                    'fields' => array('id','code','table_no'=>'concat(code,"(",capacity,")")','booking_status'),
//                                    'conditions'=>['property_id' => $select_restaurant_id,'booking_status'=>1],
                                    'conditions'=>['property_id' => $select_restaurant_id],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

        $table_array = $table_code_array = $em_table_arr = $menulist =array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                if($restaurant_tbl_ar[$i]->booking_status==1)
                {
                    $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
                    $table_code_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->code;
                    $em_table_arr[] = $restaurant_tbl_ar[$i]->code;
                }
                else
                {
                    $booked_table_code_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->code;
                }
            }
        }

//        pr($booked_table_code_array);
//        pr($em_table_arr);
//        pr($table_array);
//        pr($table_code_array);
//        pr($restaurant_tbl_ar);
//        exit;

        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        //For Restaurant Waiters
        $restaurantWaitersTable = TableRegistry::get('RestaurantWaiters');
        $waiter_list = $restaurantWaitersTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

//        pr($kitchen_list);
//        pr($waiter_list);
//        exit;

        //Check Kot number
        $lastkot_data = $this->Kots->find('all', [
//                            'fields' => array('id',''=>'concat(code,"(",capacity,")")'),
                            'conditions'=>['property_id'=>$select_restaurant_id],   // 'property_ids in' => $select_restaurant_id
                            'order'=>array('id desc')
//                        ])->first()->id;
                        ])->first();

        $nextkot_id = (isset($lastkot_data) && count($lastkot_data)>0)?$lastkot_data->id+1:1;

//        pr($lastkot_data);
//        exit;

        $this->set(compact('table_array','em_table_arr' ,'kitchen_list', 'waiter_list','menulist','nextkot_id'));

//        pr($session->read());
//        exit;

        $kot = $this->Kots->newEntity();

        if ($this->request->is('post')) {

//            pr($this->request);
//            exit;

            $RestaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $restaurant_menu_data = $RestaurantMenusTable->find('all', [
                                        'conditions'=>['id' => $this->request->data['kot_items']['restaurant_menu_id']],
                                    ])->first()->toArray();

//            pr($restaurant_menu_data);
//            exit;

//           `id`, `property_id`, `kot_no`, `restaurant_table_id`, `restaurant_table_code`, `no_of_pax`, `steward`,
//           `nc_kot`, `remark`, `split`, `amount`, `total_qty`, `bill_paid` FROM `kots`

            $this->request->data['property_id'] = $select_restaurant_id;
            $this->request->data['kot_no'] = $nextkot_id;
            $this->request->data['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
            if(in_array($this->request->data['restaurant_table_id'],$em_table_arr))
                $this->request->data['restaurant_table_code'] = $table_code_array[$this->request->data['restaurant_table_id']];
            else
                $this->request->data['restaurant_table_code'] = $booked_table_code_array[$this->request->data['restaurant_table_id']];
//            $this->request->data['no_of_pax'] = $this->request->data['no_of_pax'];
            $this->request->data['steward'] = '';
            $this->request->data['nc_kot']= ($this->request->data['nc_kot']=='Yes')?'Yes':'No';
            $this->request->data['remark'] = ($this->request->data['remark']!='')?$this->request->data['remark']:'';
            $this->request->data['split'] = (isset($this->request->data['split']) && $this->request->data['split']=='Yes')?'Yes':'No';
            //$this->request->data['amount'] = $this->request->data['amount'];
            $this->request->data['total_qty']= 1;
            $this->request->data['kot_status']= 0;

//            pr($this->request->data);
//            exit;

         //`id`, `kot_id`, `kot_no`, `restaurant_table_id`, `restaurant_waiter_id`, `restaurant_kitchen_id`,
            //`restaurant_menu_id`, `menu_code`, `menu_name`, `qty`, `menu_price`, `remarks`, `bill_paid` FROM `kot_items`

            $this->request->data['kot_items'][0]['kot_no'] = $nextkot_id;
            $this->request->data['kot_items'][0]['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
            $this->request->data['kot_items'][0]['restaurant_waiter_id'] = $this->request->data['restaurant_waiter_id'];
            $this->request->data['kot_items'][0]['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
            $this->request->data['kot_items'][0]['restaurant_menu_id'] = $this->request->data['kot_items']['restaurant_menu_id'];
            $this->request->data['kot_items'][0]['menu_code'] = $restaurant_menu_data['code'];
            $this->request->data['kot_items'][0]['menu_name'] = $restaurant_menu_data['name'];
            $this->request->data['kot_items'][0]['qty'] = $this->request->data['kot_items']['qty'];
            $this->request->data['kot_items'][0]['menu_price'] = $restaurant_menu_data['price'];
            $this->request->data['kot_items'][0]['remarks'] = '';

//            pr($this->request->data);
//            exit;

            $kot = $this->Kots->patchEntity($kot, $this->request->data, [
                'associated' => [
                    'KotItems'
                ]
            ]);

//            pr($kot);
//            exit;

            //Check for already updated or not
            if(in_array($this->request->data['restaurant_table_id'],$em_table_arr))
            {
                //update table status
                $restaurant = $propertiesTable->get($this->request->data['restaurant_table_id'], [
                ]);

                //Update restaurant table status to Occupied
                $update_tbl_status['booking_status'] = 0;   //0-occupied,1-not-occupied,3-booked
                $update_tbl_status['id'] = $this->request->data['restaurant_table_id'];
                $update_tbl_dtl = $propertiesTable->patchEntity($restaurant, $update_tbl_status);
                $update_tbl_dtl = $propertiesTable->save($update_tbl_dtl);
            }

//            pr($update_tbl_dtl);
//            pr($update_tbl_status);
           // pr($kot_items);
//            pr($kot);
//            exit;

            $last_kot_dtl = $this->Kots->save($kot, array('deep' => true));
//            echo
            $last_kot_id = $last_kot_dtl->id;
//            exit;

            if ($last_kot_id){
                $this->Flash->success(__('The {0} has been saved.', 'Kot'));
                return $this->redirect(['action' => 'add_more/'.$last_kot_id]);
            }
            else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Kot'));
            }
        }

        $this->set(compact('kot', 'properties', 'restaurantTables','select_restaurant_id'));
        $this->set('_serialize', ['kot']);

    }

    public function addMore($kotid=NULL) {

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

//        pr($session->read());
//        exit;

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->Kots->Properties->find('list', ['conditions'=>[$pass_cond]]);

        //Check Kot number
        $lastkot_data = $this->Kots->find('all', [
//                            'fields' => array('id',''=>'concat(code,"(",capacity,")")'),
                            'conditions'=>['property_id'=>$select_restaurant_id,'id'=>$kotid],   // 'property_ids in' => $select_restaurant_id
                            'order'=>array('id desc')
                        ])->first();

//        pr($lastkot_data);
//        exit;

        /* */
        $RestaurantTables = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $RestaurantTables->find('all', [
                                    'fields' => array('id','code','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id,'id'=>$lastkot_data->restaurant_table_id],
//                                    'conditions'=>['property_id' => $select_restaurant_id,'id'=>$lastkot_data->restaurant_table_id],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();


        $table_array = $table_code_array = $menulist =array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
                $table_code_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->code;
            }
        }
        /* */

//        pr($table_array);
//        pr($table_code_array);
//        pr($restaurant_tbl_ar);
//        exit;

        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        //For Restaurant Waiters
        $restaurantWaitersTable = TableRegistry::get('RestaurantWaiters');
        $waiter_list = $restaurantWaitersTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();


        /* */
        $kotitems_data = $this->Kots->KotItems->find('all', [
                            'conditions'=>['kot_id'=>$kotid],
                            'order'=>array('id asc')
                          ])->toArray();

        //pr($lastkot_data);
//        pr($kotitems_data);
//        pr($kot);
        //exit;

//        pr($kitchen_list);
//        pr($waiter_list);
//        exit;

        $this->set(compact('table_array', 'kitchen_list', 'waiter_list','menulist','lastkot_data','kotitems_data'));

//        pr($session->read());
//        exit;

        $kot = $this->Kots->newEntity();
//        $kot = $this->Kots->get($kotid, [
//            //'contain' => ['KotItems']
//        ]);
        $KotItemsTable = TableRegistry::get('KotItems');
        $kot_items = $KotItemsTable->newEntity();

//        pr($this->request->data);
//        pr($this->request);
//        exit;

        if ($this->request->is('post')) {

            //echo "vivek";
//            echo $this->request->params['pass'][0];


            if(isset($this->request->data['btngenerate_kot']) && $this->request->data['btngenerate_kot']=='Generate KOT')
            {
//                echo "IF";
//                exit;
                //pr($this->request->data);
                $gkot_id = $this->request->data['kot_id'];
                $update_kot_id = $this->Kots->updateAll(array('kot_status'=>1), array('id'=>$gkot_id));

                if ($update_kot_id){
                    $this->Flash->success(__('The {0} has been saved.', 'Kot'));
                    return $this->redirect(['action' => 'generate_kot/'.$gkot_id]);
                }
                else {
                    $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Kot'));
                }
            }
            else
            {
                $RestaurantMenusTable = TableRegistry::get('RestaurantMenus');
                $restaurant_menu_data = $RestaurantMenusTable->find('all', [
                                            'conditions'=>['id' => $this->request->data['kot_items']['restaurant_menu_id']],
                                        ])->first()->toArray();


                $kot = $this->Kots->get($kotid, [
                    //'contain' => ['KotItems']
                ]);

    //            pr($restaurant_menu_data);
    //            exit;

    //           `id`, `property_id`, `kot_no`, `restaurant_table_id`, `restaurant_table_code`, `no_of_pax`, `steward`,
    //           `nc_kot`, `remark`, `split`, `amount`, `total_qty`, `bill_paid` FROM `kots`

                $this->request->data['property_id'] = $select_restaurant_id;
                $this->request->data['kot_no'] = $this->request->params['pass'][0];
                $this->request->data['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
                $this->request->data['restaurant_table_code'] = $table_code_array[$this->request->data['restaurant_table_id']];
    //            $this->request->data['no_of_pax'] = $this->request->data['no_of_pax'];
                //$this->request->data['steward'] = 2;
                $this->request->data['nc_kot']= ($this->request->data['nc_kot']=='Yes')?'Yes':'No';
                $this->request->data['remark'] = ($this->request->data['remark']!='')?$this->request->data['remark']:'';
                $this->request->data['split'] = (isset($this->request->data['split']) && $this->request->data['split']=='Yes')?'Yes':'No';
                $this->request->data['amount'] = (!empty($kotitems_data))?$kot->amount+$this->request->data['amount']:0;
                $this->request->data['total_qty']= (!empty($kotitems_data))?$kot->total_qty+1:1;
                $this->request->data['kot_status']= 0;
                $this->request->data['id']= $this->request->params['pass'][0];


                $kots = $this->Kots->patchEntity($kot, $this->request->data);
                unset($kots['kot_items']);
    //            pr($kots);
    //            exit;

                $update_kot = 0;
                if ($this->Kots->save($kots)) {
                    $update_kot = 1;
                    //echo "Test";
                }
    //            else
    //                echo "Else";

    //            pr($kots);
    //            pr($this->request->data);
    //            exit;

                //$kot_items = $KotItemsTable->patchEntity($kot_items, $this->request->data['kot_items']);

             //`id`, `kot_id`, `kot_no`, `restaurant_table_id`, `restaurant_waiter_id`, `restaurant_kitchen_id`,
                //`restaurant_menu_id`, `menu_code`, `menu_name`, `qty`, `menu_price`, `remarks`, `bill_paid` FROM `kot_items`

                if($update_kot==1)
                {
                    $this->request->data['kot_items']['kot_no'] = $this->request->params['pass'][0];
                    $this->request->data['kot_items']['kot_id'] = $this->request->params['pass'][0];
                    $this->request->data['kot_items']['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
        //            $this->request->data['kot_items']['restaurant_waiter_id'] = $this->request->data['restaurant_waiter_id'];
                    $this->request->data['kot_items']['restaurant_waiter_id'] = 2;
                    $this->request->data['kot_items']['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
                    $this->request->data['kot_items']['restaurant_menu_id'] = $restaurant_menu_data['id'];
                    $this->request->data['kot_items']['menu_code'] = $restaurant_menu_data['code'];
                    $this->request->data['kot_items']['menu_name'] = $restaurant_menu_data['name'];
                    $this->request->data['kot_items']['qty'] = $this->request->data['kot_items']['qty'];
                    $this->request->data['kot_items']['menu_price'] = $restaurant_menu_data['price'];
                    $this->request->data['kot_items']['remarks'] = '';

        //            pr($this->request->data);
        //            exit;

                    $kot_items = $KotItemsTable->patchEntity($kot_items, $this->request->data['kot_items']);

                    if ($KotItemsTable->save($kot_items)){
                        $this->Flash->success(__('The {0} has been saved.', 'Kot'));
                        return $this->redirect(['action' => 'add-more/'.$this->request->params['pass'][0]]);
                    }
                    else {
                        $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Kot'));
                    }
                }
            }
        }
        $this->set(compact('kot', 'properties', 'restaurantTables','select_restaurant_id'));
        $this->set('_serialize', ['kot']);
    }


    public function generateKot($kotid = null)
    {
        $kot = $this->Kots->get($kotid, [
                    'contain' => ['KotItems']
        ]);

        $this->set('kot',$kot);
    }

    public function generateBill($tableid = null)
    {
        $kots = $this->Kots->find('all', [
                                    'contain' => ['KotItems'],
                                    'conditions'=>['Kots.kot_status'=>1, 'Kots.restaurant_table_code' => $tableid],
                                    'order'=>['Kots.id desc']
                                ]);
        $kot = $kots->toArray();

//        pr($kot);
//        pr($kot);
//        exit;

        $this->set('kot',$kot);
        $this->set('_serialize', ['kot']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

//        pr($this->request);
//        exit;

        $KotItemsTable = TableRegistry::get('KotItems');
        $kot_items = $KotItemsTable->get($id, [
            //'contain' => ['Kots']
        ]);

//        pr($kot_items);
//        exit;

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        //For Status array
        $status_options = $this->status_array();
        $restaurant_booking_status_array = $this->restaurant_booking_status_array();
        $this->set(compact('status_options','restaurant_booking_status_array'));

        $pass_cond = (isset($select_restaurant_id) && $select_restaurant_id!='')?'id='.$select_restaurant_id:'';
        $properties = $this->Kots->Properties->find('list', ['conditions'=>[$pass_cond]]);

        $propertiesTable = TableRegistry::get('RestaurantTables');
        $restaurant_tbl_data = $propertiesTable->find('all', [
                                    'fields' => array('id','code','table_no'=>'concat(code,"(",capacity,")")'),
                                    'conditions'=>['property_id' => $select_restaurant_id,'id'=>$kot_items->restaurant_table_id,'booking_status'=>1],
                                    'order'=>['RestaurantTables.id asc']
                                ]);
        $restaurant_tbl_ar = $restaurant_tbl_data->toArray();

        $table_array = $table_code_array = $menulist =array();
        if(!empty($restaurant_tbl_ar))
        {
            for($i=0;$i<count($restaurant_tbl_ar);$i++)
            {
                $table_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->table_no;
                $table_code_array[$restaurant_tbl_ar[$i]->id] = $restaurant_tbl_ar[$i]->code;
            }
        }
//        pr($table_array);
//        pr($table_code_array);
//        pr($restaurant_tbl_ar);
//        exit;
        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        //For Restaurant Waiters
        $restaurantWaitersTable = TableRegistry::get('RestaurantWaiters');
        $waiter_list = $restaurantWaitersTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();


        $restaurantMenusTable = TableRegistry::get('RestaurantMenus');
        $menulist = $restaurantMenusTable->find('list', [
            'conditions'=>['property_id'=> $select_restaurant_id,'restaurant_kitchen_id'=>$kot_items->restaurant_kitchen_id,'status'=>1],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        $menu_list_data = $restaurantMenusTable->find('all', [
            //'fields' => array('id','restaurant_kitchen_id','price','status'),
            'conditions'=>['property_id'=> $select_restaurant_id,'status'=>1,'id'=>$kot_items->restaurant_menu_id],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc')
        ])->first();

//        pr($kitchen_list);
//        pr($waiter_list);
//        exit;

        $this->set(compact('table_array', 'kitchen_list', 'waiter_list','menulist','menu_list_data'));

        $kot = $this->Kots->get($kot_items->kot_id, [
            //'contain' => ['Kots'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

//            pr($kot);
//            pr($kot_items);
//            pr($this->request->data);
//            exit;

            $RestaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $restaurant_menu_data = $RestaurantMenusTable->find('all', [
                                        'conditions'=>['id' => $this->request->data['kot_items']['restaurant_menu_id']],
                                    ])->first()->toArray();

//            pr($restaurant_menu_data);
//            exit;

            //Add new record in kot items
            $this->request->data['kot_items']['kot_no'] = $kot->id;
            $this->request->data['kot_items']['kot_id'] = $kot->id;
            $this->request->data['kot_items']['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
            $this->request->data['kot_items']['restaurant_waiter_id'] = $this->request->data['restaurant_waiter_id'];
            $this->request->data['kot_items']['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
            $this->request->data['kot_items']['restaurant_menu_id'] = $restaurant_menu_data['id'];
            $this->request->data['kot_items']['menu_code'] = $restaurant_menu_data['code'];
            $this->request->data['kot_items']['menu_name'] = $restaurant_menu_data['name'];
            $this->request->data['kot_items']['qty'] = $this->request->data['kot_items']['qty'];
            $this->request->data['kot_items']['menu_price'] = $restaurant_menu_data['price'];
            $this->request->data['kot_items']['remarks'] = '';

//            pr($this->request->data);
//            exit;

            $kot_items = $KotItemsTable->newEntity();
            $kot_item = $KotItemsTable->patchEntity($kot_items, $this->request->data['kot_items']);
            $insert_kot_item = $KotItemsTable->save($kot_items);

//            pr($kot_item);
//            echo $insert_kot_item->id;
//            exit;

            //Update amount and total_quantity
            $check_kotitem_data = $KotItemsTable->find('all', [
                                        'fields' => array('total_qty'=> 'count(id)','amount'=> 'sum(qty * menu_price)'),
                                        'conditions'=>['NOT'=>['KotItems.id' => $id],'KotItems.kot_id'=>$kot->id],
                                    ])->first()->toArray();

            //pr($check_kotitem_data);
//            pr($this->request->data);
//            exit;

//           `id`, `property_id`, `kot_no`, `restaurant_table_id`, `restaurant_table_code`, `no_of_pax`, `steward`,
//           `nc_kot`, `remark`, `split`, `amount`, `total_qty`, `bill_paid` FROM `kots`

            $this->request->data['property_id'] = $select_restaurant_id;
            $this->request->data['kot_no'] = $kot->id;
            $this->request->data['restaurant_table_id'] = $this->request->data['restaurant_table_id'];
            $this->request->data['restaurant_table_code'] = $table_code_array[$this->request->data['restaurant_table_id']];
//            $this->request->data['no_of_pax'] = $this->request->data['no_of_pax'];
//            $this->request->data['steward'] = 2;
            $this->request->data['nc_kot']= ($this->request->data['nc_kot']=='Yes')?'Yes':'No';
            $this->request->data['remark'] = ($this->request->data['remark']!='')?$this->request->data['remark']:'';
            $this->request->data['split'] = (isset($this->request->data['split']) && $this->request->data['split']=='Yes')?'Yes':'No';
            $this->request->data['amount'] = (isset($check_kotitem_data['amount']) && $check_kotitem_data['amount']!=0)?$check_kotitem_data['amount']:0;
            $this->request->data['total_qty'] = (isset($check_kotitem_data['total_qty']) && $check_kotitem_data['total_qty']!=0)?$check_kotitem_data['total_qty']:0;
            $this->request->data['id']= $kot->id;

            $kots = $this->Kots->patchEntity($kot, $this->request->data);
            //unset($kots['kot_items']);

//            pr($this->request->data);
//            pr($kots);
//            exit;

            if ($this->Kots->save($kots)) {

                //delete old Record
                $delete_kot_items = $KotItemsTable->get($id, [

                ]);
                if ($KotItemsTable->delete($delete_kot_items)) {
                    $this->Flash->success(__('The {0} has been saved.', 'KotItem'));
                    return $this->redirect(['action' => 'add-more/'.$kot->id]);
                } else {
                    $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'KotItem'));
                }
            }
        }

        $kot->created = $this->setdateformat($kot->created,'d-m-Y H:i:s');
        $this->set(compact('kot', 'properties', 'restaurantTables','kot_items'));
        $this->set('_serialize', ['kot']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Kot id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function kotcancel($id = null) {

        $this->request->allowMethod(['post', 'delete']);
        $kot = $this->Kots->get($id, [
                    //'contain' => ['KotItems']
                ]);
        $kot->kot_status = 3;

        if ($this->Kots->save($kot)) {
            $this->Flash->success(__('The {0} has been Cancel.', 'Kot'));
        } else {
            $this->Flash->error(__('The {0} could not be Cancel. Please, try again.', 'Kot'));
        }
        return $this->redirect(['action' => 'index']);
    }

    //Delete kot items
    public function delete($id = null) {

        //Get kot and kot items data
        $KotItemsTable = TableRegistry::get('KotItems');
        $kot_data = $KotItemsTable->get($id);

//        pr($kot_data);
//        exit;

        if(($kot_data))
        {
            $kot = $this->Kots->get($kot_data->kot_id);

            $check_kotitem_data = $KotItemsTable->find('all', [
                                                'fields' => array('total_qty'=> 'count(id)','amount'=> 'sum(qty * menu_price)'),
                                                'conditions'=>['NOT'=>['KotItems.id' => $id],'KotItems.kot_id'=>$kot->id],
                                            ])->first()->toArray();
//                                            ]);

//            pr($check_kotitem_data);
//            pr($kot_data);
//            pr($kot);
//            exit;

            $this->request->data['amount'] = $check_kotitem_data['amount'];
            $this->request->data['total_qty'] = $check_kotitem_data['total_qty'];
            $this->request->data['id'] = $kot->id;
            $kots = $this->Kots->patchEntity($kot, $this->request->data);

//            pr($kots);
//            pr($this->request->data);
//            pr($kot_data);
//            exit;

            $update_kot = 0;
            if ($this->Kots->save($kots)) {
                $update_kot = 1;
            }

            if($update_kot==1)
            {
                $this->request->allowMethod(['post', 'delete']);
                if ($KotItemsTable->delete($kot_data)) {
                    $this->Flash->success(__('The {0} has been deleted.', 'KotItem'));
                } else {
                    $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'KotItem'));
                }
                return $this->redirect(['action' => 'add-more/'.$kot->id]);

            }
        }
    }
}