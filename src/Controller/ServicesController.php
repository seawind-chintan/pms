<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 *
 * @method \App\Model\Entity\Service[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
//        echo $this->request->data['search'];
//        pr($this->request);
//        exit;

//        echo "Test";
//        exit;

        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        $pass_cond = '';
        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'Services.name like "%'.trim($this->request->query['search']).'%"';
        }
        $this->paginate = [
            'contain' => ['ParentServices'],
            'conditions'=> $pass_cond,
            'order'=>array('Services.id desc'),
//            'limit'=>2
        ];

//        $services = $this->paginate($this->Services,array('contain'=>array('ParentServices'),'conditions'=> $pass_cond,'order'=>array('Services.id desc'),'limit'=>2));
        $services = $this->paginate($this->Services);

//        debug($services);
//        pr($services);
//        exit;

        $this->set(compact('services'));
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $service = $this->Services->get($id, [
            'contain' => ['ParentServices', 'ChildServices']
        ]);

        $this->set('service', $service);
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

        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The {0} has been saved.', 'Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Service'));
            }
        }
        $parentServices = $this->Services->ParentServices->find('list', ['limit' => 200]);

//        pr($parentServices);
//        exit;

        $this->set(compact('service', 'parentServices'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The {0} has been saved.', 'Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Service'));
            }
        }
        $parentServices = $this->Services->ParentServices->find('list', ['limit' => 200]);
        $this->set(compact('service', 'parentServices'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Service'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Service'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
