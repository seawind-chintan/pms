<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        date_default_timezone_set('Asia/Kolkata');

        parent::initialize();
        
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'], // Added this line
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 1) {
            return true;
        }

        if (isset($user['role']) && $user['role'] === 2) {

            $controller_array = array('Users','Properties','Rooms','RoomTypes',
                                        'Countries','States','Cities','Channels','Reservations', 'ReservationRooms', 'Members', 'UserServices', 'RoomOccupancies' , 'RoomPlans', 'RoomRates', 'Checkins', 'CheckinBillings', 'WaterparkPrices', 'WaterparkSpecificPrices', 'WaterparkCostumelockers','WaterparkRecharges','WaterparkSettings','WaterparkBelts','WaterparkTickets', 'Dashboard',
                                            'WaterparkTaxes', 'WaterparkKots', 'WaterparkKotBillings', 'WaterparkIssuedBelts',
                                            'RestaurantTables','RestaurantKitchens','RestaurantWaiters','RestaurantMenuTypes','RestaurantMenus','RestaurantTableBookings', 'Kots',
                                        );
            $method_array = array();

            if(!empty($controller_array) && in_array($this->request->getParam('controller'),$controller_array) ||
                !empty($method_array) && in_array($this->request->getParam('action'),$method_array)){
                return true;
            }
        }

        // Default deny
        return false;
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['logout', 'login']);
    }

    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->setTheme('AdminLTE');
    }

    public function generateRandomString($length = 10) {
        $characters = '01-23-45_6789_abcdef_ghijklm-nopqr_stuvw-xyzA_BCDEFG-HIJKL_MNOP-QRSTUVWXYZ-_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function status_array()
    {
        return $status_options = array(0=>'Draft',1=>'Published');
    }

    /**
     * Process the Upload
     * @param array $check
     * @return boolean
     */
    public function processMultipleUpload($check=array(), $path = '') {
        //echo '<pre>';print_r($check);exit;
        
        $failed_images = array();
        $succeed_images = array();
        
        foreach ($check['images'] as $img_num => $image) {

            // deal with uploaded file
            if (!empty($image['tmp_name'])) {

                // check file is uploaded
                if (!is_uploaded_file($image['tmp_name'])) {
                    $failed_images[] = $image['name'];
                }

                if($path){
                    $images_move_dir = WWW_ROOT . $path . DS;
                } else {
                    $images_move_dir = WWW_ROOT . DEFAULT_IMAGES_DIR . DS;
                }

                if (!is_dir($images_move_dir)) {
                    $oldmask = umask(0);
                    mkdir($images_move_dir, 0777, true);
                    chmod($images_move_dir, 0755);
                    umask($oldmask);
                }

                // build full images
                $images = $images_move_dir . Inflector::slug(pathinfo($image['name'], PATHINFO_FILENAME)).'.'.pathinfo($image['name'], PATHINFO_EXTENSION);

                // @todo check for duplicate images

                // try moving file
                if (!move_uploaded_file($image['tmp_name'], $images)) {
                    return FALSE;

                // file successfully uploaded
                } else {
                    // save the file path relative from WWW_ROOT e.g. uploads/example_images.jpg
                    //$this->data[$this->alias]['filepath'] = str_replace(DS, "/", str_replace(WWW_ROOT, "", $images) );

                    //$succeed_images[] = DEFAULT_URL.str_replace(DS, "/", str_replace(WWW_ROOT, "", $images));
                    $succeed_images[] = str_replace(DS, "/", str_replace(WWW_ROOT, "", str_replace($images_move_dir, "", $images)));
                }
            }
        }

        $total_images = array('succeed_images' => $succeed_images, 'failed_images' => $failed_images);

        return $total_images;
    }

	//Function for set date format
    function setdateformat($date, $format='d-m-Y') {

        $return_date = date($format, strtotime($date));
        return $return_date;
    }

    function getMemberTypes(){
        return ['guest' => 'Guest', 'member' => 'Member'];
    }

    function getReservationTypes(){
        return ['inquiry' => 'Inquiry', 'booking' => 'Booking'];
    }
    function skin_array()
    {
        return ['blue'=>'Blue','red'=>'Red','white'=>'White', 'blue-light'=>'Blue Light', 'yellow'=>'Yellow', 'yellow-light'=>'Yellow Light', 'green'=>'Green', 'green-light'=>'Green Light', 'purple'=>'Purple', 'purple-light'=>'Purple Light', 'black'=>'Black', 'black-light'=>'Black Light'];
    }
    function restaurant_status_array()
    {
        return [0=>'Occupied',1=>'Not-Occupied',2=>'Booked'];
    }
    function restaurant_menu_category_array()
    {
        return [0=>'Breakfast',1=>'Lunch',2=>'Dinner'];
    }
    function restaurant_booking_status_array()
    {
        return [0=>'Attending',1=>'Booking Confirm',2=>'Booking Cancel'];
    }
}

