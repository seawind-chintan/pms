<?php
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'user-panel.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<?php
        $session = $this->request->getSession();
        $user_data = $session->read('Auth.User');
        //pr($user_data);
        $id = $user_data['id'];
        $users = TableRegistry::get('Users');
        $current_user_details = $users->get($id, [
            'contain' => ['UserDetails']
        ]);
        //pr($current_user_details);exit;
        ?>
<div class="user-panel">
    <div class="pull-left image">
        <?php //echo $this->Html->image('user2-160x160.jpg', array('class' => 'img-circle', 'alt' => 'User Image')); ?>
        <?php echo $this->Html->image($this->Url->build('/webroot/img/uploads/userdetails/profile_pic/', true). $current_user_details->user_detail->profile_pic_dir . '/square_' . $current_user_details->user_detail->profile_pic, array('class' => 'img-circle', 'alt' => 'User Image')); ?>
        <?php //echo $this->Html->image($this->Url->build('/webroot/img/uploads/userdetails/profile_pic/', true). $current_user_details->user_detail->profile_pic_dir . '/' . $current_user_details->user_detail->profile_pic); ?>
    </div>
    <div class="pull-left info">
        <p><?php if(!empty($current_user_details->user_detail->first_name)) { echo $current_user_details->user_detail->first_name.' '.$current_user_details->user_detail->last_name; } else { echo $user_data['username']; } ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<?php } ?>
