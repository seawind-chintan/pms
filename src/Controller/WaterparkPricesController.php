<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * WaterparkPrices Controller
 *
 * @property \App\Model\Table\WaterparkPricesTable $WaterparkPrices
 *
 * @method \App\Model\Entity\WaterparkPrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WaterparkPricesController extends AppController
{
    public function isAuthorized($user)
    {
        // All registered users can add articles
        // Prior to 3.4.0 $this->request->param('action') was used.
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        // Prior to 3.4.0 $this->request->param('action') was used.
        if (in_array($this->request->getParam('action'), ['edit', 'delete', 'view'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $priceId = (int)$this->request->getParam('pass.0');
            $waterparkPrice = $this->WaterparkPrices->findById($priceId)->first();
            
            return $waterparkPrice->user_id === $user['id'];
        }

        return parent::isAuthorized($user);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Properties']
        ];
        $waterparkPrices = $this->paginate($this->WaterparkPrices, ['conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('waterparkPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $waterparkPrice = $this->WaterparkPrices->get($id, [
            'contain' => ['Properties']
        ]);

        $this->set('waterparkPrice', $waterparkPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $waterparkPrice = $this->WaterparkPrices->newEntity();
        if ($this->request->is('post')) {
            $waterparkPrice = $this->WaterparkPrices->patchEntity($waterparkPrice, $this->request->data);
            $waterparkPrice->user_id = $this->Auth->user('id');
            if ($this->WaterparkPrices->save($waterparkPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Price'));
            }
        }
        $properties = $this->WaterparkPrices->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkPrice', 'properties'));
        $this->set('_serialize', ['waterparkPrice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $waterparkPrice = $this->WaterparkPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $waterparkPrice = $this->WaterparkPrices->patchEntity($waterparkPrice, $this->request->data);
            $waterparkPrice->user_id = $this->Auth->user('id');
            if ($this->WaterparkPrices->save($waterparkPrice)) {
                $this->Flash->success(__('The {0} has been saved.', 'Waterpark Price'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Waterpark Price'));
            }
        }
        $properties = $this->WaterparkPrices->Properties->find('list', ['conditions' => ['type' => 5, 'user' => $this->Auth->user('id')], 'limit' => 200]);
        $this->set(compact('waterparkPrice', 'properties'));
        $this->set('_serialize', ['waterparkPrice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Waterpark Price id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waterparkPrice = $this->WaterparkPrices->get($id);
        if ($this->WaterparkPrices->delete($waterparkPrice)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Waterpark Price'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Waterpark Price'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function gettodayprice(){

        if ($this->request->is('ajax'))
        {
            $postData = $this->request->data('myData');
            $property_id = $postData['property_id'];
            
            $waterparkSpecificPricesTable = TableRegistry::get('WaterparkSpecificPrices');
            $specific_prices = $waterparkSpecificPricesTable->find('all', [
                'fields' => ['total_price', 'ticket_price'],
                'conditions' => ['status' => 1, 'property_id' => $property_id, "OR" => ["single_date" => date('Y-m-d'), "AND" => ["from_date <=" => date('Y-m-d'), "to_date >=" => date('Y-m-d') ]]]
            ]);

            //pr($specific_prices->toArray());exit;
            if(count($specific_prices->toArray()) > 0){
                $specific_price = $specific_prices->first();
                
                $total_price = $specific_price->total_price;
                $ticket_price = $specific_price->ticket_price;
                /*$waterparkBeltsTable = TableRegistry::get('WaterparkBelts');
                $waterparkBelt = $waterparkBeltsTable->find('all', [
                    'conditions' => ['property_id' => $property_id]
                ]);

                if(!empty($waterparkBelt->last())){
                    $lastCodeArr = explode($setting->belt_code_prefix, $waterparkBelt->last()->code);
                    $lastWaterparkBelt = $lastCodeArr[1];
                } else {
                    $lastWaterparkBelt = 0;
                }

                //$lastWaterparkBelt = ((!empty($waterparkBelt->last())) ? explode($setting->belt_code_prefix, $waterparkBelt->last()->code[1]) : 0 );

                //pr($lastWaterparkBelt);exit;

                $newWaterparkBelt = (int) $lastWaterparkBelt + 1;

                $new_code_to_be = $setting->belt_code_prefix.$newWaterparkBelt;
                echo $new_code_to_be;exit;*/
                //echo json_encode($setting);exit;
                $return_data = array();
                $return_data['total_price'] = $total_price;
                $return_data['ticket_price'] = $ticket_price;
                echo json_encode($return_data);exit;

            } else {
                
                $current_day = strtolower(date('l'));
                $prices = $this->WaterparkPrices->find('all', [
                    'fields' => [$current_day.'_total_price', $current_day.'_ticket_price'],
                    'conditions' => ['property_id' => $property_id]
                ]);

                if(count($prices->toArray()) > 0){
                    $price = $prices->first();

                    $total_price = $price->{$current_day.'_total_price'};
                    $ticket_price = $price->{$current_day.'_ticket_price'};
                    //pr($total_price);
                    //pr($ticket_price);exit;
                    $return_data = array();
                    $return_data['total_price'] = $total_price;
                    $return_data['ticket_price'] = $ticket_price;
                    echo json_encode($return_data);exit;

                } else {
                    echo 'false';exit;
                }
            }
        }
    }
}
