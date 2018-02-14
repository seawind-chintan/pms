<section class="content-header">
    <h1>
        User Service
        <small><?= __('Edit') ?></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Form') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($userService, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('user_id', ['options' => $users]);
                    //echo $this->Form->input('services');
                    echo '<label for="user-id">Services</label>';
                    echo '<br>';
                    $service_array = explode(',',$userService->services);
                    foreach ($services_arr as $k => $service_txt) {

                        $t = 0;
                        if (!empty($service_txt['child'])) {
                            //echo '<br>';
                            echo $service_txt['name'];

                            foreach ($service_txt['child'] as $sub_id => $sub_service_txt) {
                                $checked = '';
                                if(in_array($sub_id,$service_array))
                                    $checked = 'checked';

//                                echo $this->Form->input('services[' . $sub_service_txt['id'] . ']', array(
                                echo $this->Form->input('services[]', array(
                                    'label' => $sub_service_txt['name'],
                                    'type' => 'checkbox',
                                    'value' => $sub_service_txt['id'],
                                    $checked
                                        //'before' => '<label>'.$sub_service_txt['name'].'</lablel>',
                                ));
                                $t++;
                            }
                        }
                    }

                    $selected = array();
                    echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options, 'selected' => $selected));
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Save')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

