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
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'], // Added this line
            'loginRedirect' => [
                'controller' => 'Users',
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
            if($this->request->getParam('controller') == "Users"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Properties"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Rooms"){
                return true;
            }
            elseif($this->request->getParam('controller') == "RoomTypes"){
                return true;
            }
            elseif($this->request->getParam('controller') == "RoomStatuses"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Countries"){
                return true;
            }
            elseif($this->request->getParam('controller') == "States"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Cities"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Packages"){
                return true;
            }
            elseif($this->request->getParam('controller') == "Channels"){
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
}
