<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 *
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertiesController extends AppController
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
        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            // Prior to 3.4.0 $this->request->params('pass.0')
            $propertyId = (int)$this->request->getParam('pass.0');
            $property = $this->Properties->findById($propertyId)->first();

            return $property->user === $user['id'];
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
            'contain' => ['PropertyTypes']
        ];
        $properties = $this->paginate($this->Properties, ['conditions' => ['user' => $this->Auth->user('id')]]);

        $this->set(compact('properties'));
    }

    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyTypes']
        ]);

        $this->set('property', $property);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $property = $this->Properties->newEntity();
        if ($this->request->is('post')) {
            $property = $this->Properties->patchEntity($property, $this->request->data);
            $property->user = $this->Auth->user('id');
            if ($this->Properties->save($property)) {
                $this->Flash->success(__('The {0} has been saved.', 'Property'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Property'));
            }
        }
        $propertyTypes = $this->Properties->PropertyTypes->find('list', ['limit' => 200]);
        $this->set(compact('property', 'propertyTypes'));
        $this->set('_serialize', ['property']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyTypes'/*, 'PropertyImages'*/]
        ]);
        //pr($property);exit;

        /*$propertyImagesTable = TableRegistry::get('PropertyImages');
        $propertyimages = $propertyImagesTable->findByProperty($id)->all();*/
        //pr($propertyimages);exit;

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            /*if(isset($propertyimages) && !empty($propertyimages)){
                $propertyimages = $this->Properties->PropertyImages->patchEntity($propertyimages, $this->request->getData('property_image'));
            } else {
                $propertyimages = $this->Properties->PropertyImages->newEntity();
                $propertyimages = $this->Properties->PropertyImages->patchEntity($propertyimages, $this->request->getData('property_image'));
            }*/

            //pr($propertyimages);exit;
            //pr($this->request->data);exit;
            $property = $this->Properties->patchEntity($property, $this->request->data);
            /*$property->property = $id;
            $property->image = $propertyimages;*/
            $property->user = $this->Auth->user('id');

            //pr($property);exit;
            if ($this->Properties->save($property)) {
                $this->Flash->success(__('The {0} has been saved.', 'Property'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Property'));
            }
        }
        $propertyTypes = $this->Properties->PropertyTypes->find('list', ['limit' => 200]);
        $this->set(compact('property', 'propertyTypes'));
        $this->set('_serialize', ['property']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Properties->get($id);
        if ($this->Properties->delete($property)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Property'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Property'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
