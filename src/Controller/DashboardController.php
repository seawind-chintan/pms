<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Channels Controller
 *
 * @property \App\Model\Table\ChannelsTable $Channels
 *
 * @method \App\Model\Entity\Channel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        /*//For get status array
        $status_options = $this->status_array();
        $this->set('status_options',$status_options);

        $pass_cond = '';
        if(isset($this->request->data['search']) && trim($this->request->data['search'])!='')
        {
            return $this->redirect(array('action' => 'index',"?" => array('search'=>trim($this->request->data['search']))));
        }

        if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
        {
            $pass_cond = 'Channels.name like "%'.trim($this->request->query['search']).'%"';
        }

        $channels = $this->paginate($this->Channels,array('conditions'=>$pass_cond,'order'=>array('id desc'),'limit'=>2));

        $this->set(compact('channels'));*/
    }
    
}
