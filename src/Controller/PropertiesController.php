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
            /*pr($property);exit;
            $lastRecord = $this->Properties->find('first', array('columns' => array('id'), 'order' => 'id DESC'));
            $lastId = (int) $lastRecord['Property']['id'];
            $lastId++;*/

            $image_dir = $this->generateRandomString(25);

            // for properties images
            $first_fail_imgs = array();
            $insert_properties_data_array = array();
            $insert_properties_data_array['images'] = $this->request->data['images'];
            if(count($insert_properties_data_array['images']) > 0){
                foreach ($insert_properties_data_array['images'] as $ff_img_num => $ff_img) {
                    //var_dump($ff_img);
                    if($ff_img['error'] == "1"){
                        $first_fail_imgs[] = $ff_img['name'];
                    }
                }

                if(count($first_fail_imgs) > 0){
                    
                    $insert_properties_data_array['images'] = '';
                    $customValidate = false;
                    $customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

                } else {
                    $images_result = $this->Properties->processMultipleUpload($insert_properties_data_array, $image_dir);
                    //pr($images_result);exit;
                    $fail_imgs = array();

                    if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
                        foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
                            $fail_imgs[] = $fail_img;
                        }

                        $insert_properties_data_array['images'] = '';
                        $customValidate = false;
                        $customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

                    } else {
                        $suc_imgs = array();
                        if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
                            foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
                                $suc_imgs[] = $suc_img;
                            }

                            $insert_properties_data_array['images'] = implode(',', $suc_imgs);
                        } else {
                            $insert_properties_data_array['images'] = false;
                        }
                    }
                }
                
            } else {
                $insert_properties_data_array['images'] = false;
            }
            // for news images

            $property->user = $this->Auth->user('id');
            $property->images = $insert_properties_data_array['images'];
            $property->images_dir = $image_dir;

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
        if(!empty($property->images_dir)){
            $images_dir = $property->images_dir;
        } else {
            $images_dir = $this->generateRandomString(25);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $property = $this->Properties->patchEntity($property, $this->request->data);
            
            //pr($this->request->data);exit;
            // for properties images
            $first_fail_imgs = array();
            $insert_properties_data_array = array();
            $insert_properties_data_array['images'] = $this->request->data['images'];
            if(count($insert_properties_data_array['images']) > 0){
                foreach ($insert_properties_data_array['images'] as $ff_img_num => $ff_img) {
                    //var_dump($ff_img);
                    if($ff_img['error'] == "1"){
                        $first_fail_imgs[] = $ff_img['name'];
                    }
                }

                if(count($first_fail_imgs) > 0){
                    
                    $insert_properties_data_array['images'] = '';
                    $customValidate = false;
                    $customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

                } else {
                    $images_result = $this->Properties->processMultipleUpload($insert_properties_data_array, $images_dir);
                    //pr($images_result);exit;
                    $fail_imgs = array();

                    if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
                        foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
                            $fail_imgs[] = $fail_img;
                        }

                        $insert_properties_data_array['images'] = '';
                        $customValidate = false;
                        $customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

                    } else {
                        $suc_imgs = array();
                        if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
                            foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
                                $suc_imgs[] = $suc_img;
                            }

                            $insert_properties_data_array['images'] = implode(',', $suc_imgs);
                        } else {
                            $insert_properties_data_array['images'] = false;
                        }
                    }
                }
                
            } else {
                $insert_properties_data_array['images'] = false;
            }
            // for news images
            //pr($this->request->data);exit;
            // for edit images only
            $insert_properties_data_array['add_image'] = $this->request->data['add_image'];
            if(isset($insert_properties_data_array['add_image'])){
                if (count($insert_properties_data_array['add_image']) > 0)
                {   
                    if(!empty($insert_properties_data_array['images'])){
                        $insert_properties_data_array['images'] = explode(',', $insert_properties_data_array['images']);
                        $insert_properties_data_array['images'] = array_merge($insert_properties_data_array['add_image'], $insert_properties_data_array['images']);
                        $insert_properties_data_array['add_image'] = false;
                        $insert_properties_data_array['images'] = implode(',', $insert_properties_data_array['images']);
                    } else {
                        $insert_properties_data_array['images'] = $insert_properties_data_array['add_image'];
                        $insert_properties_data_array['add_image'] = false;
                        $insert_properties_data_array['images'] = implode(',', $insert_news_data_array['images']);
                    }
                }
            }
            // for edit images only
            //pr($insert_properties_data_array);exit;

            //pr($insert_properties_data_array['images']);exit;
            $property->user = $this->Auth->user('id');
            $property->images = $insert_properties_data_array['images'];
            $property->images_dir = $images_dir;

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
