<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * WaterparkKotBillings Controller
 *
 * @property \App\Model\Table\WaterparkKotBillingsTable $WaterparkKotBillings
 *
 * @method \App\Model\Entity\WaterparkKotBilling[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkKotBillingsController extends AppController
{
    //Display generate bill but not bill paid data
    public function unsettledBill()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');
        
        $this->paginate = [
            'contain' => ['WaterparkKotItemBillings', 'RestaurantKitchens'],
            'conditions'=>['WaterparkKotBillings.property_id'=> $select_restaurant_id,'WaterparkKotBillings.bill_status'=> 0],
        ];
        $waterparkKotBillings = $this->paginate($this->WaterparkKotBillings);

        pr($waterparkKotBillings);
        exit;

        $this->set(compact('waterparkKotBillings'));
    }

    //Display paid bill data
    public function settledBill()
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');


        $this->paginate = [
            'contain' => ['WaterparkKotItemBillings', 'RestaurantKitchens'],
            'conditions'=>['WaterparkKotBillings.property_id'=> $select_restaurant_id,'waterparkKotBillings.bill_status'=> 0],
        ];
        
        $waterparkKotBillings = $this->paginate($this->WaterparkKotBillings);

        // pr($waterparkKotBillings);
        // exit;

        $this->set(compact('waterparkKotBillings'));   
    }

    //Add data for Generate bill
    function generateBill($kotid = null)
    {

        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');
        $login_user_id = $this->Auth->User('id');

        //Get kot informationto generate bill
        $waterparkKotsTable = TableRegistry::get('WaterparkKots');
        $waterpark_kot = $waterparkKotsTable->find('all', [
                    'contain' => ['WaterparkKotItems'],
                    'conditions'=>['WaterparkKots.property_id'=> $select_restaurant_id,'id'=>$kotid],
        ])->first();


        // echo "test";
        // pr($waterpark_kot);
        // exit;


        if($waterpark_kot->kot_status==2)
        {
            //echo 'redirect page to bill_data';

            $set_bill_kot_data = $this->WaterparkKotBillings->find('all', [
                            'conditions'=>['waterpark_kot_id'=>$kotid]
                        ])->first();
            // echo "test";
            // pr($set_bill_kot_data);
            // exit;

            return $this->redirect(['action' => 'bill_data/'.$set_bill_kot_data->id]);
        }
        else
        {
            // echo "Else";
            // exit;

            $waterparkTaxesTable = TableRegistry::get('WaterparkTaxes');
            $gettax_data = $waterparkTaxesTable->find('all', [
                                'fields' => ['id','restaurant_menu_type_id', 'cgst','sgst'],
                                'conditions'=>['user_id'=>$login_user_id],
                                'order'=>array('id asc')
                            ])->toArray();

            if($gettax_data)
            {
                $tax_array = array();
                for($i=0;$i<count($gettax_data);$i++)
                {
                    $tax_array[$gettax_data[$i]->restaurant_menu_type_id]['id'] = $gettax_data[$i]->id;
                    $tax_array[$gettax_data[$i]->restaurant_menu_type_id]['restaurant_menu_type_id'] = $gettax_data[$i]->restaurant_menu_type_id;
                    $tax_array[$gettax_data[$i]->restaurant_menu_type_id]['cgst'] = $gettax_data[$i]->cgst;
                    $tax_array[$gettax_data[$i]->restaurant_menu_type_id]['sgst'] = $gettax_data[$i]->sgst;
                }
            }
            // pr($gettax_data);
            // pr($waterpark_kot);
            // exit;

            if($waterpark_kot)
            {
                //Update kot to paid status
                $waterparkKotsTable = TableRegistry::get('WaterparkKots');
                $update_kot_id = $waterparkKotsTable->updateAll(array('kot_status'=>2), array('id'=>$kotid));

                //waterpark_kot_billings
                //`id`, `user_id`, `property_id`, `waterpark_kot_id`, `waterpark_belt_id`, `restaurant_kitchen_id`, `waterpark_kot_no`,
                //`total_amount`, `total_qty`, `total_cgst`, `total_sgst`, `bill_status`, `bill_date`, `created`, `modified`

                $new_kot_bill_array = array();
                $new_kot_bill_array['user_id'] = $waterpark_kot->user_id;
                $new_kot_bill_array['property_id'] = $waterpark_kot->property_id;
                $new_kot_bill_array['waterpark_kot_id'] = $waterpark_kot->id;
                $new_kot_bill_array['waterpark_belt_id'] = 0;
                $new_kot_bill_array['restaurant_kitchen_id'] = $waterpark_kot->restaurant_kitchen_id;
                $new_kot_bill_array['waterpark_kot_no'] = $waterpark_kot->waterpark_kot_no;
                $new_kot_bill_array['total_amount'] = $waterpark_kot->total_amount;
                $new_kot_bill_array['total_qty'] = $waterpark_kot->total_qty;
                $new_kot_bill_array['total_cgst'] = 0;
                $new_kot_bill_array['total_sgst'] = 0;
                $new_kot_bill_array['bill_status'] = 0;   //0-generate, 1-paid
                $new_kot_bill_array['bill_date'] = date('Y-m-d');

    //            pr($new_kot_bill_array);

                //echo 'Total Items '.
                $total_items = count($waterpark_kot->waterpark_kot_items);

                // waterpark_kot_item_billings
                //`id`, `property_id`, `waterpark_kot_id`, `waterpark_kot_billing_id`, `waterpark_kot_no`, `restaurant_kitchen_id`,
                //`restaurant_menu_id`, restaurant_menu_type_id, `menu_code`, `menu_name`, `price`, `qty`, `total_price`,
                //`cgst`, `sgst`, `kot_item_date`,
                if($waterpark_kot->waterpark_kot_items)
                {
                    $item_array = array();
                    $tot_cgst = $tot_sgst = 0;
                    for($i=0;$i<$total_items;$i++)
                    {
    //                    echo '<br>Total Price '.$waterpark_kot->waterpark_kot_items[$i]->total_price;
    //                    echo '<br>Menu '.$waterpark_kot->waterpark_kot_items[$i]->restaurant_menu_type_id;
                        //calculate tax based on menu type id
                        //cgst calculation
                        //echo '<br>CGST '.
                        $cal_cgst = $waterpark_kot->waterpark_kot_items[$i]->total_price * ($tax_array[$waterpark_kot->waterpark_kot_items[$i]->restaurant_menu_type_id]['cgst']/100);
                        //sgst calculation
                        //echo '<br>SGST '.
                        $cal_sgst = $waterpark_kot->waterpark_kot_items[$i]->total_price * ($tax_array[$waterpark_kot->waterpark_kot_items[$i]->restaurant_menu_type_id]['sgst']/100);


                        $single_item_data = $waterpark_kot->waterpark_kot_items[$i] ;
    //                    pr($single_item_data);
    //                    exit;

                        $item_array[$i]['property_id'] = $single_item_data->property_id;
                        $item_array[$i]['waterpark_kot_id'] = $single_item_data->waterpark_kot_id;
                        $item_array[$i]['waterpark_kot_no'] = $single_item_data->waterpark_kot_no;
                        $item_array[$i]['restaurant_kitchen_id'] = $single_item_data->id;
                        $item_array[$i]['restaurant_menu_id'] = $single_item_data->restaurant_menu_id;
                        $item_array[$i]['restaurant_menu_type_id'] = $single_item_data->restaurant_menu_type_id;
                        $item_array[$i]['menu_code'] = $single_item_data->menu_code;
                        $item_array[$i]['menu_name'] = $single_item_data->menu_name;
                        $item_array[$i]['price'] = $single_item_data->price;
                        $item_array[$i]['qty'] = $single_item_data->qty;
                        $item_array[$i]['total_price'] = $single_item_data->total_price;
                        $item_array[$i]['cgst'] = $cal_cgst;
                        $item_array[$i]['sgst'] = $cal_sgst;
                        $item_array[$i]['kot_item_date'] = date('Y-m-d');

                        $tot_cgst = $tot_cgst + $cal_cgst;
                        $tot_sgst = $tot_sgst + $cal_sgst;
                    }
                }
                //echo 'CGST-'.$tot_cgst.' SGST-'.$tot_sgst;

                $new_kot_bill_array['total_cgst'] = $tot_cgst;
                $new_kot_bill_array['total_sgst'] = $tot_sgst;
                $new_kot_bill_array['waterpark_kot_item_billings'] = $item_array;

    //            pr($new_kot_bill_array['waterpark_kot_item_billings']);
               // pr($new_kot_bill_array);
               // exit;

                $waterparkKotBilling_data = $this->WaterparkKotBillings->newEntity();
                $waterparkKotBilling = $this->WaterparkKotBillings->patchEntity($waterparkKotBilling_data, $new_kot_bill_array);
                $last_kot_dtl = $this->WaterparkKotBillings->save($waterparkKotBilling);

                //echo
                $waterpark_last_kot_id = $last_kot_dtl->id;
    //            pr($waterparkKotBilling);

                if($waterpark_last_kot_id)
                {
                    return $this->redirect(['action' => 'bill_data/'.$waterpark_last_kot_id]);
                    exit;
                }

    //            pr($new_kot_bill_array);
    //            pr($item_array);
    //            pr($waterpark_kot);
    //            pr($waterparkKotBilling);
    //            pr($new_kot_bill_array);


            }
        }
    }

    function billData($billid = null)
    {
        //For get default property id
        $session = $this->request->session();
        $select_restaurant_id = $session->read('default_restaurant_id');

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $properties = $this->WaterparkKotBillings->Properties->find('all', ['conditions' => ['type' => 5, 'user' => $club_admin_user_id]])->first();

        $waterparkKotBilling = $this->WaterparkKotBillings->get($billid, [
//            'contain' => ['Users', 'Properties', 'WaterparkKots', 'WaterparkBelts', 'RestaurantKitchens', 'WaterparkKotItemBillings']
            'contain' => ['RestaurantKitchens', 'WaterparkKotItemBillings']
        ]);

        // pr($waterparkKotBilling);
        // exit;

        $this->set(compact('waterparkKotBilling','properties'));
        $propperty_id = $properties->id;

//        pr($waterparkKotBilling);
//        pr($properties);
//        exit;

        $waterparkIssuedBeltsTable = TableRegistry::get('WaterparkIssuedBelts');
        $issue_belt_data = $waterparkIssuedBeltsTable->find('all', [
            'fields' => ['WaterparkIssuedBelts.id', 'WaterparkIssuedBelts.property_id', 'WaterparkIssuedBelts.ticket_id', 'WaterparkIssuedBelts.belt_id', 'WaterparkIssuedBelts.issued_date', 'WaterparkIssuedBelts.status', 'WaterparkBelts.property_id', 'WaterparkBelts.code'],
            'conditions'=>['WaterparkIssuedBelts.property_id'=> $propperty_id],
            'order'=>array('WaterparkIssuedBelts.id asc')
        ])->join([
                    'WaterparkBelts' => [
                        'table' => 'waterpark_belts',
                        'type' => 'inner',
                        'conditions' => '(WaterparkBelts.id = WaterparkIssuedBelts.belt_id)'
                    ]
                ])->toArray();

        $issue_belt_array  = $belt_data_array = array();

        if($issue_belt_data)
        {
            
            for($i=0;$i<count($issue_belt_data);$i++)
            {
                $belt_data_array[$issue_belt_data[$i]->belt_id]['id'] = $issue_belt_data[$i]->id;
                $belt_data_array[$issue_belt_data[$i]->belt_id]['property_id'] = $issue_belt_data[$i]->property_id;
                $belt_data_array[$issue_belt_data[$i]->belt_id]['ticket_id'] = $issue_belt_data[$i]->ticket_id;
                $belt_data_array[$issue_belt_data[$i]->belt_id]['belt_id'] = $issue_belt_data[$i]->belt_id;
                $belt_data_array[$issue_belt_data[$i]->belt_id]['balance'] = $issue_belt_data[$i]->balance;
                $belt_data_array[$issue_belt_data[$i]->belt_id]['code'] = $issue_belt_data[$i]->WaterparkBelts['code'];

                $issue_belt_array[$issue_belt_data[$i]->belt_id] = $issue_belt_data[$i]->WaterparkBelts['code'];
                $ticket_id = $issue_belt_data[$i]->ticket_id;
                $property_id = $issue_belt_data[$i]->property_id;
            }
        }


//        pr($issue_belt_array);
//        pr($belt_data_array);
//        exit;

        $waterparkBeltTransactionsTable = TableRegistry::get('WaterparkBeltTransactions');
        $waterparkBeltTransaction = $waterparkBeltTransactionsTable->newEntity();
        if ($this->request->is('post')) {

//            pr($waterparkKotBilling);
//            exit;

            //Update kot to paid status
            $waterparkKotsTable = TableRegistry::get('WaterparkKots');
            $update_kot_id = $waterparkKotsTable->updateAll(array('kot_status'=>4), array('id'=>$waterparkKotBilling->waterpark_kot_id));

            //Add Entry in waterpark_belt_transactions table
            //`property_id`, `belt_id`, `kot_billing_id`, `transaction_type`, `bill_amount`, `tax_amount`, `net_amount`, `status`
            $tax_amount = ($waterparkKotBilling->total_cgst + $waterparkKotBilling->total_sgst);
//            echo "Cut Amount ".
            $pay_amount = ($waterparkKotBilling->total_amount + $tax_amount);

            $add_transaction_array = array();
            $add_transaction_array['property_id'] = $property_id;
            $add_transaction_array['belt_id'] = $this->request->data['belt_id'];
            $add_transaction_array['kot_billing_id'] = $this->request->data['bill_id'];
            $add_transaction_array['transaction_type'] = 0;
            $add_transaction_array['bill_amount'] = $waterparkKotBilling->total_amount;
            $add_transaction_array['tax_amount'] = $tax_amount;
            $add_transaction_array['net_amount'] = $pay_amount;
            $add_transaction_array['status'] = 1;

//            pr($add_transaction_array);
//            exit;
            $waterparkBeltTransaction_data = $waterparkBeltTransactionsTable->newEntity();
            $waterparkBeltTransaction = $waterparkBeltTransactionsTable->patchEntity($waterparkBeltTransaction_data, $add_transaction_array);
            $transaction = $waterparkBeltTransactionsTable->save($waterparkBeltTransaction);
            $transaction_id = $transaction->id;
//            pr($waterparkBeltTransaction);
//            exit;

            //Update balance in from main balance from waterpark_tickets
            $waterparkTicketsTable = TableRegistry::get('WaterparkTickets');
            $ticket_data = $waterparkTicketsTable->get($ticket_id, [
                        'conditions'=>['property_id'=> $property_id],
            ]);

            //echo '<br>'.
            $ticket_data->balance = $ticket_data->balance - $pay_amount;
            $update_ticket_balance = $waterparkTicketsTable->save($ticket_data);

//            pr($ticket_data);
//            pr($this->request);
//            exit;

            //Update bill status generate to paid
            $waterparkKotBilling->waterpark_belt_id = $this->request->data['belt_id'];
            $waterparkKotBilling->bill_status = 1;

            if ($this->WaterparkKotBillings->save($waterparkKotBilling)) {
                $this->Flash->success(__('The {0} has been paid.', 'Bill'));

                return $this->redirect(['action' => 'bill_print/'.$waterparkKotBilling->id]);
            } else {
                $this->Flash->error(__('The {0} could not be paid. Please, try again.', 'Bill'));
            }
        }
        $this->set(compact('issue_belt_array','waterparkBeltTransaction'));
        $this->set('_serialize', ['waterparkBeltTransaction']);
    }

    function billPrint($billid = null)
    {
        $this->viewBuilder()->layout('print');

        if($this->Auth->User('role')==3)
            $club_admin_user_id = $this->Auth->User('parent');
        else
            $club_admin_user_id = $this->Auth->User('id');

        $waterparkKotBilling = $this->WaterparkKotBillings->get($billid, [
//            'contain' => ['Users', 'Properties', 'WaterparkKots', 'WaterparkBelts', 'RestaurantKitchens', 'WaterparkKotItemBillings']
            'contain' => ['RestaurantKitchens', 'WaterparkKotItemBillings']
        ]);

        $properties = $this->WaterparkKotBillings->Properties->find('all', ['conditions' => ['type' => 5, 'user' => $club_admin_user_id]])->first();

        $this->set(compact('waterparkKotBilling','properties'));
//        pr($waterparkKotBilling);
//        pr($properties);
//        exit;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Properties', 'WaterparkKots', 'WaterparkBelts', 'RestaurantKitchens']
        ];
        $waterparkKotBillings = $this->paginate($this->WaterparkKotBillings);

        $this->set(compact('waterparkKotBillings'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Kot Billing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkKotBilling = $this->WaterparkKotBillings->get($id, [
            'contain' => ['Users', 'Properties', 'WaterparkKots', 'WaterparkBelts', 'RestaurantKitchens', 'WaterparkKotItemBillings']
        ]);

        $this->set('waterparkKotBilling', $waterparkKotBilling);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkKotBilling = $this->WaterparkKotBillings->newEntity();
        if ($this->request->is('post')) {
            $waterparkKotBilling = $this->WaterparkKotBillings->patchEntity($waterparkKotBilling, $this->request->data);
            if ($this->WaterparkKotBillings->save($waterparkKotBilling)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Kot Billing'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Kot Billing'));
            }
        }
        $users = $this->WaterparkKotBillings->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkKotBillings->Properties->find('list', ['limit' => 200]);
        $waterparkKots = $this->WaterparkKotBillings->WaterparkKots->find('list', ['limit' => 200]);
        $waterparkBelts = $this->WaterparkKotBillings->WaterparkBelts->find('list', ['limit' => 200]);
        $restaurantKitchens = $this->WaterparkKotBillings->RestaurantKitchens->find('list', ['limit' => 200]);
        $this->set(compact('waterparkKotBilling', 'users', 'properties', 'waterparkKots', 'waterparkBelts', 'restaurantKitchens'));
        $this->set('_serialize', ['waterparkKotBilling']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Kot Billing id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkKotBilling = $this->WaterparkKotBillings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkKotBilling = $this->WaterparkKotBillings->patchEntity($waterparkKotBilling, $this->request->data);
            if ($this->WaterparkKotBillings->save($waterparkKotBilling)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Kot Billing'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Kot Billing'));
            }
        }
        $users = $this->WaterparkKotBillings->Users->find('list', ['limit' => 200]);
        $properties = $this->WaterparkKotBillings->Properties->find('list', ['limit' => 200]);
        $waterparkKots = $this->WaterparkKotBillings->WaterparkKots->find('list', ['limit' => 200]);
        $waterparkBelts = $this->WaterparkKotBillings->WaterparkBelts->find('list', ['limit' => 200]);
        $restaurantKitchens = $this->WaterparkKotBillings->RestaurantKitchens->find('list', ['limit' => 200]);
        $this->set(compact('waterparkKotBilling', 'users', 'properties', 'waterparkKots', 'waterparkBelts', 'restaurantKitchens'));
        $this->set('_serialize', ['waterparkKotBilling']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Kot Billing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkKotBilling = $this->WaterparkKotBillings->get($id);
        if ($this->WaterparkKotBillings->delete($waterparkKotBilling)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Kot Billing'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Kot Billing'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
