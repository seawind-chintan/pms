<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 *
 * @method \App\Model\Entity\Member[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MembersController extends AppController
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
        $this->set('status_options', $status_options);

//        pr($status_options);
//        exit;

        if (isset($this->request->data['search']) && trim($this->request->data['search']) != '') {
            return $this->redirect(array('action' => 'index', "?" => array('search' => trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if (isset($this->request->query['search']) && trim($this->request->query['search']) != '') {
            $pass_cond = 'Members.name like "%' . trim($this->request->query['search']) . '%"';
        }

        $this->paginate = [
            'contain' => ['Packages', 'MemberGroups'],
            'conditions' => ['parent' => $this->Auth->user('id')],
            'order' => array('Members.id desc')
        ];

        $members = $this->paginate($this->Members);
        //pr($members);exit;

        $this->set(compact('members'));
    }

    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //For get status array
        $member = $this->Members->get($id, [
            'contain' => ['Packages', 'MemberGroups']
        ]);

//        pr($member);
//        exit;

        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);
        $countries = $countries->toArray();

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $states = $states->toArray();

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);
        $cities = $cities->toArray();

        $this->set(compact('countries','states','cities'));

        /* *
        // For services
        $servicesTable = TableRegistry::get('Services');
        $services = $servicesTable->find('all', array(
            'fields' => array('id', 'name'),
            'conditions' => array('Services.status' => 1,'Services.id in'=>explode(',',$member->services))
        ));
        $service_arr = $parent_arr = array();
        $service_data = '';
        if (!empty($services)) {
            foreach ($services as $services_key => $services_value) {
                $services_arr[] = $services_value['name'];
            }
            $service_data = implode(', ',$services_arr);
        }

//        pr($services_arr);
//        exit;

        $this->set(compact('services_arr'));
        /* */

        //Display Fields and set value
        $member->cor_city = $cities[$member->cor_city];
        $member->cor_state = $states[$member->cor_state];
        $member->cor_country = $countries[$member->cor_country];

        $member->res_city = $cities[$member->res_city];
        $member->res_state = $states[$member->res_state];
        $member->res_country = $countries[$member->res_country];
        //$member->services = $service_data;
        $member->birth_date = ($member->birth_date!='0000-00-00' && $member->birth_date!='')?$this->setdateformat($member->birth_date):'';
        $member->anniversary_date = ($member->anniversary_date!='0000-00-00' && $member->anniversary_date!='')?$this->setdateformat($member->anniversary_date):'';
        $member->status = $status_options[$member->status];

//        pr($member);
//        exit;

        $this->set('member', $member);
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
        $this->set('status_options', $status_options);

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $this->set(compact('countries','states','cities'));

        /* *
        // For services
        $servicesTable = TableRegistry::get('Services');
        $services = $servicesTable->find('all', array(
            'fields' => array('id', 'name', 'parent_id'),
            'conditions' => array('Services.status' => 1), 'order' => 'id asc'
        ));

        $service_arr = $parent_arr = array();

        if (!empty($services)) {
            foreach ($services as $services_key => $services_value) {

                if (empty($services_value->parent_id)) {

                    $services_arr[$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->id]['name'] = $services_value['name'];
                    //$services_arr[$services_value->id]['parent_id'] = $services_value['parent_id'];
                    $services_arr[$services_value->id]['child'] = array();
                } else {
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['name'] = $services_value['name'];
//                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['parent_id'] = $services_value['parent_id'];
                }
            }
        }

        $this->set(compact('services_arr'));

//        pr($services_arr);
//        exit;
        /* */

        $member = $this->Members->newEntity();
        if ($this->request->is('post')) {
//            $this->request->data['services'] = implode(',', array_filter($this->request->data['services']));
            $this->request->data['services'] = 'as';
            $this->request->data['birth_date'] = ($this->request->data['birth_date']!='')?$this->setdateformat($this->request->data['birth_date'],'Y-m-d'):'';
            $this->request->data['anniversary_date'] = ($this->request->data['anniversary_date']!='')?$this->setdateformat($this->request->data['anniversary_date'],'Y-m-d'):'';
//            echo count($this->request->data);

//            pr($this->request);
//            exit;

            $member = $this->Members->patchEntity($member, $this->request->data);
            $member->parent = $this->Auth->user('id');
            if(empty($member->member_type)) $member->member_type = 'member';
            //pr($member);
            //exit;

            if ($this->Members->save($member)) {
                $this->Flash->success(__('The {0} has been saved.', 'Member'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Member'));
            }
        }
        $packages = $this->Members->Packages->find('list', ['limit' => 200]);
        $memberGroups = $this->Members->MemberGroups->find('list', ['limit' => 200]);
        $this->set(compact('member', 'packages', 'memberGroups'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);

        $countriesTable = TableRegistry::get('Countries');
        $countries = $countriesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $statesTable = TableRegistry::get('States');
        $states = $statesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $citiesTable = TableRegistry::get('Cities');
        $cities = $citiesTable->find('list', [ 'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => array('status' => 1),
            'order' => 'name asc'
        ]);

        $this->set(compact('countries','states','cities'));

        /* *
        // For services
        $servicesTable = TableRegistry::get('Services');
        $services = $servicesTable->find('all', array(
            'fields' => array('id', 'name', 'parent_id'),
            'conditions' => array('Services.status' => 1), 'order' => 'id asc'
        ));

//            pr($services->toArray());
//            pr($userService->toArray());
//            exit;

        $service_arr = $parent_arr = array();

        if (!empty($services)) {
            foreach ($services as $services_key => $services_value) {

                if (empty($services_value->parent_id)) {

                    $services_arr[$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->id]['name'] = $services_value['name'];
                    //$services_arr[$services_value->id]['parent_id'] = $services_value['parent_id'];
                    $services_arr[$services_value->id]['child'] = array();
                } else {
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['id'] = $services_value['id'];
                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['name'] = $services_value['name'];
//                    $services_arr[$services_value->parent_id]['child'][$services_value->id]['parent_id'] = $services_value['parent_id'];
                }
            }
        }

        $this->set(compact('services_arr'));
//        pr($services_arr);
//        exit;
        /* */

        $member = $this->Members->get($id, [
            'contain' => []
        ]);

        $member->birth_date = ($member->birth_date!='' && $member->birth_date!='0000-00-00')?$this->setdateformat($member->birth_date, 'd-m-Y'):'';
        $member->anniversary_date = ($member->anniversary_date!='' && $member->anniversary_date!='0000-00-00')?$this->setdateformat($member->anniversary_date, 'd-m-Y'):'';

//        pr($member);
//        exit;

        if ($this->request->is(['patch', 'post', 'put'])) {

            //$this->request->data['services'] = implode(',', array_filter($this->request->data['services']));
            $this->request->data['services'] = '';
            $this->request->data['birth_date'] = ($this->request->data['birth_date']!='')?$this->setdateformat($this->request->data['birth_date'],'Y-m-d'):'';
            $this->request->data['anniversary_date'] = ($this->request->data['anniversary_date']!='')?$this->setdateformat($this->request->data['anniversary_date'],'Y-m-d'):'';

//            pr($this->request->data);
//            exit;

            $member = $this->Members->patchEntity($member, $this->request->data);
            $member->parent = $this->Auth->user('id');
            if ($this->Members->save($member)) {
                $this->Flash->success(__('The {0} has been saved.', 'Member'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Member'));
            }
        }
        $packages = $this->Members->Packages->find('list', ['limit' => 200]);
        $memberGroups = $this->Members->MemberGroups->find('list', ['limit' => 200]);
        $this->set(compact('member', 'packages', 'memberGroups'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $member = $this->Members->get($id);
        if ($this->Members->delete($member)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Member'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Member'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
