<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
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
            $roomId = (int)$this->request->getParam('pass.0');
            $room = $this->Rooms->findById($roomId)->first();
            if($room){
                return $room->user_id === $user['id'];
            } else {
                return false;
            }
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
            'contain' => ['Users', 'RoomTypes', 'RoomOccupancies', 'Properties']
        ];

        $rooms = $this->paginate($this->Rooms, ['conditions' => ['Rooms.user_id' => $this->Auth->user('id')]]);
        //pr($rooms);exit;
        $this->set(compact('rooms'));
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => ['Users', 'RoomTypes', 'Properties']
        ]);
        //pr($room);
        $this->set('room', $room);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->data);exit;
            $room = $this->Rooms->patchEntity($room, $this->request->data);
            $room->room_occupancy = $this->request->data['room_occupancy'];
            //pr($room);exit;
            $room->user_id = $this->Auth->user('id');
            //$room->slug = Inflector::slug($room->name);
            $image_dir = $this->generateRandomString(25);
            //pr($this->request->data);exit;
            // for properties images
            $first_fail_imgs = array();
            $insert_rooms_data_array = array();
            $insert_rooms_data_array['images'] = $this->request->data['images'];
            if(count($insert_rooms_data_array['images']) > 0){
                foreach ($insert_rooms_data_array['images'] as $ff_img_num => $ff_img) {
                    //var_dump($ff_img);
                    if($ff_img['error'] == "1"){
                        $first_fail_imgs[] = $ff_img['name'];
                    }
                }

                if(count($first_fail_imgs) > 0){
                    
                    $insert_rooms_data_array['images'] = '';
                    $customValidate = false;
                    $customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

                } else {
                    $images_result = $this->processMultipleUpload($insert_rooms_data_array, ROOMS_IMAGES_UPLOAD_DIR.'/'.$image_dir);
                    //pr($images_result);exit;
                    $fail_imgs = array();

                    if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
                        foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
                            $fail_imgs[] = $fail_img;
                        }

                        $insert_rooms_data_array['images'] = '';
                        $customValidate = false;
                        $customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

                    } else {
                        $suc_imgs = array();
                        if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
                            foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
                                $suc_imgs[] = $suc_img;
                            }

                            $insert_rooms_data_array['images'] = implode(',', $suc_imgs);
                        } else {
                            $insert_rooms_data_array['images'] = false;
                        }
                    }
                }
                
            } else {
                $insert_rooms_data_array['images'] = false;
            }
            // for news images

            $room->images = $insert_rooms_data_array['images'];
            $room->images_dir = $image_dir;
            //pr($room);exit;
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room'));
            }
        }
        $users = $this->Rooms->Users->find('list', ['limit' => 200]);
        $roomtypes = $this->Rooms->RoomTypes->find('list', ['conditions' => ['status' => '1', 'user_id' => $this->Auth->user('id')], 'limit' => 200]);
        $roomoccupancies = $this->Rooms->RoomOccupancies->find('list', ['conditions' => ['status' => '1', 'user_id' => $this->Auth->user('id')], 'limit' => 200]);
        $properties = $this->Rooms->Properties->find('list', ['conditions' => ['user' => $this->Auth->user('id'), 'status' => '1', 'type' => 1], 'limit' => 200]);
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);
        $this->set(compact('room', 'users', 'roomtypes', 'properties', 'roomoccupancies'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);

        if(!empty($room->images_dir)){
            $image_dir = $room->images_dir;
        } else {
            $image_dir = $this->generateRandomString(25);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->data);
            $room->room_occupancy = $this->request->data['room_occupancy'];
            $room->user_id = $this->Auth->user('id');
            //$room->slug = Inflector::slug($room->name);
            //pr($this->request->data);exit;
            // for properties images
            $first_fail_imgs = array();
            $insert_rooms_data_array = array();
            $insert_rooms_data_array['images'] = $this->request->data['images'];
            if(count($insert_rooms_data_array['images']) > 0){
                foreach ($insert_rooms_data_array['images'] as $ff_img_num => $ff_img) {
                    //var_dump($ff_img);
                    if($ff_img['error'] == "1"){
                        $first_fail_imgs[] = $ff_img['name'];
                    }
                }

                if(count($first_fail_imgs) > 0){
                    
                    $insert_rooms_data_array['images'] = '';
                    $customValidate = false;
                    $customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

                } else {
                    $images_result = $this->processMultipleUpload($insert_rooms_data_array, ROOMS_IMAGES_UPLOAD_DIR.'/'.$image_dir);
                    //pr($images_result);exit;
                    $fail_imgs = array();

                    if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
                        foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
                            $fail_imgs[] = $fail_img;
                        }

                        $insert_rooms_data_array['images'] = '';
                        $customValidate = false;
                        $customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

                    } else {
                        $suc_imgs = array();
                        if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
                            foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
                                $suc_imgs[] = $suc_img;
                            }

                            $insert_rooms_data_array['images'] = implode(',', $suc_imgs);
                        } else {
                            $insert_rooms_data_array['images'] = false;
                        }
                    }
                }
                
            } else {
                $insert_rooms_data_array['images'] = false;
            }
            // for news images
            // for edit images only
            if(isset($this->request->data['add_image'])){
                $insert_rooms_data_array['add_image'] = $this->request->data['add_image'];
                if (count($insert_rooms_data_array['add_image']) > 0)
                {   
                    if(!empty($insert_rooms_data_array['images'])){
                        $insert_rooms_data_array['images'] = explode(',', $insert_rooms_data_array['images']);
                        $insert_rooms_data_array['images'] = array_merge($insert_rooms_data_array['add_image'], $insert_rooms_data_array['images']);
                        $insert_rooms_data_array['add_image'] = false;
                        $insert_rooms_data_array['images'] = implode(',', $insert_rooms_data_array['images']);
                    } else {
                        $insert_rooms_data_array['images'] = $insert_rooms_data_array['add_image'];
                        $insert_rooms_data_array['add_image'] = false;
                        $insert_rooms_data_array['images'] = implode(',', $insert_rooms_data_array['images']);
                    }
                }
            }
            // for edit images only

            $room->images = $insert_rooms_data_array['images'];
            $room->images_dir = $image_dir;
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The {0} has been saved.', 'Room'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Room'));
            }
        }
        $users = $this->Rooms->Users->find('list', ['limit' => 200]);
        $roomtypes = $this->Rooms->RoomTypes->find('list', ['conditions' => ['status' => '1', 'user_id' => $this->Auth->user('id')], 'limit' => 200]);
        $roomoccupancies = $this->Rooms->RoomOccupancies->find('list', ['conditions' => ['status' => '1', 'user_id' => $this->Auth->user('id')], 'limit' => 200]);
        $properties = $this->Rooms->Properties->find('list', ['conditions' => ['status' => '1', 'user' => $this->Auth->user('id'), 'type' => 1], 'limit' => 200]);
        $status_options = $this->status_array();
        $this->set('status_options', $status_options);
        $this->set(compact('room', 'users', 'roomtypes', 'properties', 'roomoccupancies'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Room'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Room'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function showroomrack(){
        $properties = $this->Rooms->Properties->find('list', ['conditions' => ['user' => $this->Auth->user('id'), 'status' => '1', 'type' => 1], 'limit' => 200]);
        $this->set(compact('properties'));
    }

    public function getroomrackbyproperty(){
        
        if ($this->request->is('post'))
        {
            $postData = $this->request->data('myData');
            $property_id = $postData['property_id'];

            if(!empty($property_id))
            {
                $rooms_for_rack = $this->Rooms->find('all', ['contain' => ['RoomTypes', 'RoomOccupancies'], 'conditions' => ['property_id' => $property_id, 'Rooms.status' => '1'], 'limit' => 200]);
                //pr($rooms_for_rack->toArray());exit;
                $this->set(compact('rooms_for_rack'));
            } else {
                return false;
            }
        }
    }

    public function getroomsbyproperty(){
        
        if ($this->request->is('post'))
        {
            $postData = $this->request->data('myData');
            $property_id = $postData['property_id'];

            if(!empty($property_id))
            {
                $rooms_for_rack = $this->Rooms->find('all', ['contain' => ['RoomTypes', 'RoomOccupancies'], 'conditions' => ['property_id' => $property_id, 'Rooms.status' => '1', 'Rooms.room_status_id' => '1'], 'limit' => 200]);
                //pr($rooms_for_rack->toArray());exit;
                $this->set(compact('rooms_for_rack'));
            } else {
                return false;
            }
        }
    }

     public function getroomratebyroom(){
        
        if ($this->request->is('ajax'))
        {
            $postData = $this->request->data('myData');
            $room_id = $postData['room_id'];
            $row_id = $postData['row_id'];
            
            $room = $this->Rooms->get($room_id);

            $roomratesTable = TableRegistry::get('RoomRates');
            $roomrate = $roomratesTable->find('all', [
                'contain' => ['RoomTypes', 'RoomOccupancies', 'RoomPlans'],
                'conditions' => ['RoomRates.status' => 1, 'RoomRates.property_id' => $room->property_id, 'RoomRates.room_type_id' => $room->type, 'RoomRates.room_occupancy_id' => $room->room_occupancy ]
            ]);
            if(count($roomrate->toArray()) > 0){
                $this->set(compact('roomrate', 'room', 'row_id'));
            } else {
                echo 'false';exit;
            }
        }
    }

    public function getadultbyroomrate(){
        
        if ($this->request->is('ajax'))
        {
            $postData = $this->request->data('myData');
            $room_rate_id = $postData['roomrate_id'];
            $row_id = $postData['row_id'];
            //var_dump($row_id);exit;
            
            $roomratesTable = TableRegistry::get('RoomRates');
            $roomrate = $roomratesTable->find('all', [
                'contain' => ['RoomTypes', 'RoomOccupancies', 'RoomPlans'],
                'conditions' => ['RoomRates.id' => $room_rate_id]
            ]);
            //pr($roomrate->toArray());exit;
            if(count($roomrate->toArray()) > 0){
                $this->set(compact('roomrate', 'row_id'));
            } else {
                echo 'false';exit;
            }
        }
    }

    public function getachildbyroomrate(){
        
        if ($this->request->is('ajax'))
        {
            $postData = $this->request->data('myData');
            $room_id = $postData['room_id'];
            
            $room = $this->Rooms->get($room_id);

            $roomratesTable = TableRegistry::get('RoomRates');
            $roomrate = $roomratesTable->find('all', [
                'contain' => ['RoomTypes', 'RoomOccupancies', 'RoomPlans'],
                'conditions' => ['RoomRates.status' => 1, 'RoomRates.property_id' => $room->property_id, 'RoomRates.room_type_id' => $room->type, 'RoomRates.room_occupancy_id' => $room->room_occupancy ]
            ]);
            if(count($roomrate->toArray()) > 0){
                $this->set(compact('roomrate'));
            } else {
                echo 'false';exit;
            }
        }
    }

    public function roomavailability(){
        
    }
}