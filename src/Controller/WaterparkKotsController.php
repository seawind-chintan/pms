<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * WaterparkKots Controller
 *
 * @property \App\Model\Table\WaterparkKotsTable $WaterparkKots
 *
 * @method \App\Model\Entity\WaterparkKot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkKotsController extends AppController
{
    //For get ajax menu list in ajax call
    function ajaxMenuList($kitchenid = null)
    { 
  
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
        }
    }

    //For get ajax menu price in ajax call
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

    //Generate kot and update to close kot
    public function generateKot($kotid = null)
    {
        //for change layout
        $this->viewBuilder()->layout('print');

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');


        $waterpark_kot = $this->WaterparkKots->get($kotid, [
                    'contain' => ['WaterparkKotItems'=>['RestaurantKitchens']],
                    'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,'WaterparkKots.kot_status'=>1],
        ]);
//        pr($waterpark_kot);
//        exit;

        if($waterpark_kot)
        {
            $total_item = (count($waterpark_kot->waterpark_kot_items));

            $diff_kitchen_array = $kitchen_ar = $kitchen_list_ar = array();
            for($i=0;$i<($total_item);$i++)
            {
                //echo '<br>'.
                $kit_id = $waterpark_kot->waterpark_kot_items[$i]->restaurant_kitchen_id;

                if(!in_array($kit_id,$kitchen_ar))
                {
                    $diff_kitchen_array[$kit_id][] = $waterpark_kot->waterpark_kot_items[$i];
                    $kitchen_ar[] = $kit_id;
                    $kitchen_list_ar[$kit_id] = $waterpark_kot->waterpark_kot_items[$i]->restaurant_kitchen->name;
                }
                else
                {
                    $diff_kitchen_array[$kit_id][] = $waterpark_kot->waterpark_kot_items[$i];
                }
            }
        }

//        pr($kitchen_ar);
//        pr($kitchen_list_ar);
//        pr($diff_kitchen_array);
//        pr($waterpark_kot);
//        exit;

        $this->set(compact('kitchen_ar','kitchen_list_ar','diff_kitchen_array'));
        $this->set('kot',$waterpark_kot);
    }

    //Display open kot list
    public function index()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

//        $pass_cond = 'WaterparkKots.kot_status in (0,1)';
        $this->paginate = [
//            'contain' => ['Users', 'Properties', 'RestaurantKitchens'],
            'contain' => ['RestaurantKitchens'],
            'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,'WaterparkKots.kot_status'=>0],
//            'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,$pass_cond],
            'order'=>array('WaterparkKots.id asc')
        ];
        $waterparkKots = $this->paginate($this->WaterparkKots);

        $this->set(compact('waterparkKots'));
    }

    //Display close kot list
    public function closeKot($kotid = null)
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        if($kotid!='')
        {
            $check_status_kot = $this->WaterparkKots->get($kotid, [
                    'contain' => ['WaterparkKotItems'],
                    'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id],
            ]);
            if($check_status_kot->kot_status==0)
            {
                $gkot_id = $check_status_kot->id;
                $update_kot_id = $this->WaterparkKots->updateAll(array('kot_status'=>1), array('id'=>$gkot_id));
            }
            $this->set(compact('kotid'));
            ?>
            <script>
                window.location.replace("<?php echo DEFAULT_URL."waterpark-kots/closeKot/";?>");
                window.open("<?php echo DEFAULT_URL."waterpark-kots/generateKot/".$kotid;?>", "_blank");
            </script>
            <?php
        }
//        echo "Close";
//        exit;

//        $pass_cond = 'WaterparkKots.kot_status in (0,1)';
        $this->paginate = [
//            'contain' => ['Users', 'Properties', 'RestaurantKitchens'],
            'contain' => ['RestaurantKitchens'],
            'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,'WaterparkKots.kot_status in'=>[1,2]],
            'order'=>array('WaterparkKots.id desc')
        ];
        $waterparkKots = $this->paginate($this->WaterparkKots);

        $this->set(compact('waterparkKots'));
    }

    //Update status to cancel and redirect to cancel kot list
    public function kotcancel($id = null) {

        $this->request->allowMethod(['post', 'delete']);
        $kot = $this->WaterparkKots->get($id, [
                    //'contain' => ['KotItems']
                ]);
        $kot->kot_status = 3;

        if ($this->WaterparkKots->save($kot)) {
            $this->Flash->success(__('The {0} has been Cancel.', 'Kot'));
            return $this->redirect(['action' => 'cancel_kot']);
        } else {
            $this->Flash->error(__('The {0} could not be Cancel. Please, try again.', 'Kot'));
        }
    }

    //Display cancel kot list
    public function cancelKot()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

//        $pass_cond = 'WaterparkKots.kot_status in (0,1)';
        $this->paginate = [
//            'contain' => ['Users', 'Properties', 'RestaurantKitchens'],
            'contain' => ['RestaurantKitchens'],
            'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,'WaterparkKots.kot_status'=>3],
            'order'=>array('WaterparkKots.id desc')
        ];
        $waterparkKots = $this->paginate($this->WaterparkKots);

        $this->set(compact('waterparkKots'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Kot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //echo $this->referer();

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $waterparkKot = $this->WaterparkKots->get($id, [
            'contain' => ['Users', 'Properties', 'RestaurantKitchens', 'WaterparkKotItems'],
            'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id],
        ]);
        $back_url = $this->referer();
        $this->set('waterparkKot', $waterparkKot);
        $this->set('back_url', $back_url);
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

        $menulist = array();

        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        //Check Kot number
        $lastkot_data = $this->WaterparkKots->find('all', [
//                            'fields' => array('id',''=>'concat(code,"(",capacity,")")'),
                            'conditions'=>['property_id'=>$select_restaurant_id],   // 'property_ids in' => $select_restaurant_id
                            'order'=>array('id desc')
//                        ])->first()->id;
                        ])->first();

        $nextkot_id = (isset($lastkot_data) && count($lastkot_data)>0)?$lastkot_data->id+1:1;

//        pr($lastkot_data);
//        exit;

        $this->set(compact('kitchen_list', 'nextkot_id','menulist'));

        $waterparkKot = $this->WaterparkKots->newEntity();
        if ($this->request->is('post')) {

            $RestaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $restaurant_menu_data = $RestaurantMenusTable->find('all', [
                                        'conditions'=>['id' => $this->request->data['waterpark_kot_items']['restaurant_menu_id']],
                                    ])->first()->toArray();

            //waterpark_kots
            //`id`, `user_id`, `property_id`, `restaurant_kitchen_id`, `waterpark_kot_no`, `total_amount`, `total_qty`, `kot_status`, `kot_date`, `created`, `modified` FROM `waterpark_kots`
            $this->request->data['user_id'] = $this->Auth->User('id');
            $this->request->data['property_id'] = $select_restaurant_id;
            $this->request->data['waterpark_kot_no'] = $nextkot_id;
            $this->request->data['total_amount'] = $this->request->data['amount'];
            $this->request->data['total_qty'] = 1;
            $this->request->data['kot_status'] = 0;
            $this->request->data['kot_date'] = date('Y-m-d');

            //waterpark_kot_items
            //`id`, `property_id`, `waterpark_kot_id`, `waterpark_kot_no`, `restaurant_kitchen_id`, `restaurant_menu_id`,
            //`menu_code`, `menu_name`, `price`, `qty`, `total_price`, `kot_item_date`, `created`
            $this->request->data['waterpark_kot_items'][0]['property_id'] = $select_restaurant_id;
            $this->request->data['waterpark_kot_items'][0]['waterpark_kot_no'] = $nextkot_id;
            $this->request->data['waterpark_kot_items'][0]['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
            $this->request->data['waterpark_kot_items'][0]['restaurant_menu_id'] = $this->request->data['waterpark_kot_items']['restaurant_menu_id'];
            $this->request->data['waterpark_kot_items'][0]['restaurant_menu_type_id'] = $restaurant_menu_data['restaurant_menu_type_id'];
            $this->request->data['waterpark_kot_items'][0]['menu_code'] = $restaurant_menu_data['code'];
            $this->request->data['waterpark_kot_items'][0]['menu_name'] = $restaurant_menu_data['name'];
            $this->request->data['waterpark_kot_items'][0]['price'] = $restaurant_menu_data['price'];
            $this->request->data['waterpark_kot_items'][0]['qty'] = $this->request->data['waterpark_kot_items']['qty'];
            $this->request->data['waterpark_kot_items'][0]['total_price'] = $this->request->data['amount'];
            $this->request->data['waterpark_kot_items'][0]['kot_item_date'] = date('Y-m-d');

            $waterparkKot = $this->WaterparkKots->patchEntity($waterparkKot, $this->request->data);

//            pr($waterparkKot);
//            pr($this->request->data);
//            pr($restaurant_menu_data);
//            exit;

//            $last_kot_dtl = $this->Kots->save($kot, array('deep' => true));
            $last_kot_dtl = $this->WaterparkKots->save($waterparkKot);
//            echo
            $waterpark_last_kot_id = $last_kot_dtl->id;

            if ($waterpark_last_kot_id){

                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Kot'));
                return $this->redirect(['action' => 'add_more/'.$waterpark_last_kot_id]);
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Kot'));
            }
        }

//        $users = $this->WaterparkKots->Users->find('list', ['limit' => 200]);
//        $properties = $this->WaterparkKots->Properties->find('list', ['limit' => 200]);
//        $restaurantKitchens = $this->WaterparkKots->RestaurantKitchens->find('list', ['limit' => 200]);
//        $this->set(compact('waterparkKot', 'users', 'properties', 'restaurantKitchens'));
        $this->set(compact('waterparkKot'));
        $this->set('_serialize', ['waterparkKot']);
    }

    public function addMore($kotid=NULL) {

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $menulist = array();

        //Check Kot number
        $lastkot_data = $this->WaterparkKots->find('all', [
                            'conditions'=>['property_id'=>$select_restaurant_id,'id'=>$kotid],   // 'property_ids in' => $select_restaurant_id
                        ])->first();

//        pr($lastkot_data);
//        exit;

        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

//        pr($kitchen_list);
//        exit;

        /* */
        $kotitems_data = $this->WaterparkKots->WaterparkKotItems->find('all', [
                            'conditions'=>['waterpark_kot_id'=>$kotid],
                            'order'=>array('id asc')
                          ])->toArray();

//        pr($lastkot_data);
//        pr($kotitems_data);
//        exit;

        $this->set(compact( 'kitchen_list', 'menulist','lastkot_data','kotitems_data'));

        $waterparkKot = $this->WaterparkKots->newEntity();

        if ($this->request->is('post')) {

//            pr($this->request);
//            exit;

            if(isset($this->request->data['btngenerate_kot']) && $this->request->data['btngenerate_kot']=='Generate KOT')
            {
                echo "IF";
                exit;
                //pr($this->request->data);
                $gkot_id = $this->request->data['kot_id'];
                $update_kot_id = $this->WaterparkKots->updateAll(array('kot_status'=>1), array('id'=>$gkot_id));

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
                                            'conditions'=>['id' => $this->request->data['waterpark_kot_items']['restaurant_menu_id']],
                                        ])->first()->toArray();

                //waterpark_kots
                //`id`, `user_id`, `property_id`, `restaurant_kitchen_id`, `waterpark_kot_no`, `total_amount`, `total_qty`, `kot_status`, `kot_date`, `created`, `modified` FROM `waterpark_kots`

                $this->request->data['total_amount'] = (!empty($kotitems_data))? ($lastkot_data->total_amount + $this->request->data['amount']):0;
                $this->request->data['total_qty']= (!empty($kotitems_data))? ($lastkot_data->total_qty + 1):1;
                $this->request->data['kot_status']= 0;

//                pr($this->request->data);
//                exit;

                //waterpark_kot_items
                //`id`, `property_id`, `waterpark_kot_id`, `waterpark_kot_no`, `restaurant_kitchen_id`, `restaurant_menu_id`,
                //`menu_code`, `menu_name`, `price`, `qty`, `total_price`, `kot_item_date`, `created`
                $this->request->data['waterpark_kot_items'][0]['property_id'] = $select_restaurant_id;
                $this->request->data['waterpark_kot_items'][0]['waterpark_kot_no'] = $this->request->params['pass'][0];
                $this->request->data['waterpark_kot_items'][0]['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
                $this->request->data['waterpark_kot_items'][0]['restaurant_menu_id'] = $this->request->data['waterpark_kot_items']['restaurant_menu_id'];
                $this->request->data['waterpark_kot_items'][0]['restaurant_menu_type_id'] = $restaurant_menu_data['restaurant_menu_type_id'];
                $this->request->data['waterpark_kot_items'][0]['menu_code'] = $restaurant_menu_data['code'];
                $this->request->data['waterpark_kot_items'][0]['menu_name'] = $restaurant_menu_data['name'];
                $this->request->data['waterpark_kot_items'][0]['price'] = $restaurant_menu_data['price'];
                $this->request->data['waterpark_kot_items'][0]['qty'] = $this->request->data['waterpark_kot_items']['qty'];
                $this->request->data['waterpark_kot_items'][0]['total_price'] = $this->request->data['amount'];
                $this->request->data['waterpark_kot_items'][0]['kot_item_date'] = date('Y-m-d');

                unset($this->request->data['amount']);
//                pr($this->request->data);
//                exit;

                $waterparkKot = $this->WaterparkKots->patchEntity($lastkot_data, $this->request->data);

//                pr($waterparkKot);
//                pr($this->request->data);
//                pr($restaurant_menu_data);
//                exit;

                $last_kot_dtl = $this->WaterparkKots->save($waterparkKot);
                //echo
                $waterpark_last_kot_id = $last_kot_dtl->id;
                //exit;

                if ($waterpark_last_kot_id){

                    $this->Flash->success(__('The {0} has been saved.', 'Waterpark Kot'));
                    return $this->redirect(['action' => 'add_more/'.$waterpark_last_kot_id]);
                } else {
                    $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Kot'));
                }
            }
        }

        $this->set(compact('waterparkKot','select_restaurant_id'));
        $this->set('_serialize', ['waterparkKot']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Kot id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        $WaterparkKotItemsTable = TableRegistry::get('WaterparkKotItems');
        $waterpark_kot_items = $WaterparkKotItemsTable->get($id, [
            'contain' => ['WaterparkKots']
        ]);


//        pr($waterpark_kot_items);
//        exit;

        $menulist = array();

        //For Restaurant Kitchen
        $restaurantKitchensTable = TableRegistry::get('RestaurantKitchens');
        $kitchen_list = $restaurantKitchensTable->find('list', [
            'conditions'=>['FIND_IN_SET('. $select_restaurant_id .',property_ids)'],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        $restaurantMenusTable = TableRegistry::get('RestaurantMenus');
        $menulist = $restaurantMenusTable->find('list', [
            'conditions'=>['property_id'=> $select_restaurant_id,'restaurant_kitchen_id'=>$waterpark_kot_items->restaurant_kitchen_id,'status'=>1],   // 'property_ids in' => $select_restaurant_id
            'order'=>array('id asc'),
            'limit' => 200
        ])->toArray();

        $this->set(compact('kitchen_list', 'menulist','waterpark_kot_items'));

//        pr($waterparkKot);
//        exit;

        $waterparkKot = $this->WaterparkKots->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $RestaurantMenusTable = TableRegistry::get('RestaurantMenus');
            $restaurant_menu_data = $RestaurantMenusTable->find('all', [
                                        'conditions'=>['id' => $this->request->data['waterpark_kot_items']['restaurant_menu_id']],
                                    ])->first()->toArray();

//            pr($restaurant_menu_data);
//            exit;

            $this->request->data['property_id'] = $select_restaurant_id;
            $this->request->data['waterpark_kot_no'] = $this->request->params['pass'][0];
            $this->request->data['restaurant_kitchen_id'] = $this->request->data['restaurant_kitchen_id'];
            $this->request->data['restaurant_menu_id'] = $this->request->data['waterpark_kot_items']['restaurant_menu_id'];
            $this->request->data['menu_code'] = $restaurant_menu_data['code'];
            $this->request->data['menu_name'] = $restaurant_menu_data['name'];
            $this->request->data['price'] = $restaurant_menu_data['price'];
            $this->request->data['qty'] = $this->request->data['waterpark_kot_items']['qty'];
            $this->request->data['total_price'] = $this->request->data['amount'];
            $this->request->data['kot_item_date'] = date('Y-m-d');


//            $upddate_kot_item = $WaterparkKotItemsTable->save($waterpark_kot_item);

            //Update amount and total_quantity
            $check_kotitem_data = $WaterparkKotItemsTable->find('all', [
                                        'fields' => array('total_qty'=> 'count(id)','amount'=> 'sum(qty * price)'),
                                        'conditions'=>['NOT'=>['WaterparkKotItems.id' => $id],'WaterparkKotItems.waterpark_kot_id'=>$waterpark_kot_items->waterpark_kot_id],
                                    ])->first();


            //$waterpark_kot_items->waterpark_kot->total_qty = $check_kotitem_data->total_qty;
            $waterpark_kot_items->waterpark_kot->total_amount = ($check_kotitem_data->amount + $this->request->data['amount']);
            $waterpark_kot_items->waterpark_kot->kot_status = 0;

            //Update WaterparkKots
            $update_kot = $this->WaterparkKots->save($waterpark_kot_items->waterpark_kot);

            $waterpark_kot_item = $WaterparkKotItemsTable->patchEntity($waterpark_kot_items, $this->request->data);

//            echo $update_id = $WaterparkKotItemsTable->save($waterpark_kot_item);

//            pr($waterpark_kot_items->waterpark_kot->total_amount);
//            pr($waterpark_kot_items->waterpark_kot->total_qty);
//            pr($waterpark_kot_item);
//            exit;

            /* *
            pr($waterpark_kot_item);
            pr($this->request);
            exit;

            $kot_items = $KotItemsTable->newEntity();


//            pr($kot_item);
//            echo $insert_kot_item->id;
//            exit;

            //Update amount and total_quantity
            $check_kotitem_data = $KotItemsTable->find('all', [
                                        'fields' => array('total_qty'=> 'count(id)','amount'=> 'sum(qty * menu_price)'),
                                        'conditions'=>['NOT'=>['KotItems.id' => $id],'KotItems.kot_id'=>$kot->id],
                                    ])->first()->toArray();
            /* */

            if ($WaterparkKotItemsTable->save($waterpark_kot_item)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Kot'));
                return $this->redirect(['action' => 'add_more/'.$waterpark_kot_items->waterpark_kot_id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Kot'));
            }
        }

//        $users = $this->WaterparkKots->Users->find('list', ['limit' => 200]);
//        $properties = $this->WaterparkKots->Properties->find('list', ['limit' => 200]);
        $restaurantKitchens = $this->WaterparkKots->RestaurantKitchens->find('list', ['limit' => 200]);
        $this->set(compact('waterparkKot', 'users', 'properties', 'restaurantKitchens','waterparkKotItems'));
        $this->set('_serialize', ['waterparkKot']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Kot id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $WaterparkKotItemsTable = TableRegistry::get('WaterparkKotItems');
        $waterpark_kot_items = $WaterparkKotItemsTable->get($id, [
            'contain' => ['WaterparkKots']
        ]);


        $waterpark_kot_id = $waterpark_kot_items->waterpark_kot_id;

        if(($waterpark_kot_items))
        {
            $cal_kotitem_data = $WaterparkKotItemsTable->find('all', [
                                                'fields' => array('total_qty'=> 'count(id)','amount'=> 'sum(qty * price)'),
                                                'conditions'=>['NOT'=>['WaterparkKotItems.id' => $id],'WaterparkKotItems.waterpark_kot_id'=>$waterpark_kot_id],
                                            ])->first()->toArray();
//            pr($cal_kotitem_data);
//            exit;

            //Update WaterparkKots
            $waterpark_kot_items->waterpark_kot->total_amount = $cal_kotitem_data['amount'];
            $waterpark_kot_items->waterpark_kot->total_qty = $cal_kotitem_data['total_qty'];
            $delete_update_kot = $this->WaterparkKots->save($waterpark_kot_items->waterpark_kot);

//            pr($waterpark_kot_items);
//            exit;

            if($delete_update_kot)
            {
                $this->request->allowMethod(['post', 'delete']);
                if ($WaterparkKotItemsTable->delete($waterpark_kot_items)) {
                    $this->Flash->success(__('The {0} has been deleted.', 'KotItem'));
                } else {
                    $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'KotItem'));
                }
                return $this->redirect(['action' => 'add-more/'.$waterpark_kot_id]);
            }
        }
    }
}
