<section class="content-header">
    <h1>
        User Service
        <small><?= __('Add') ?></small>
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
                    //pr($users);
                    //for
                    echo $this->Form->input('user_id', ['onChange'=>'showservice(this.value)','options' => $users]);
//            echo $this->Form->input('user_id', array('label' => 'Status', 'class' => 'form-control', 'options' => $user));
//            echo $this->Form->input('services');
//            pr($services_arr);
//            exit;

                    echo '<div id="service_div"></div>';

                    /* *
                    echo '<label for="user-id">Services</label>';
                    echo '<br>';
                    foreach ($services_arr as $k => $service_txt) {

                        $t = 0;
                        if (!empty($service_txt['child'])) {
                            //echo '<br>';
                            echo $service_txt['name'];

                            foreach ($service_txt['child'] as $sub_id => $sub_service_txt) {

//                                echo $this->Form->input('services[' . $sub_service_txt['id'] . ']', array(
                                echo $this->Form->input('services[]', array(
                                    'label' => $sub_service_txt['name'],
                                    'id' => 'textbox_' . $sub_id,
                                    'type' => 'checkbox',
                                    'value' => $sub_service_txt['id'],
                                ));
                                $t++;
                            }
                        }
                    }
                    //echo $this->Form->input('status');
                    $selected = array();
                    echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options, 'selected' => $selected));
                    /* */
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

<script type="text/javascript">
function showCities(id)
{
//alert(id);
//alert("hello");
//var state = jQuery('#userdetail-state').val();
//alert(state);
//dataString="state_id="+id;
//jQuery('#userdetail-city').parent().attr('id', "city-area")
  $.ajax({
            url: "/club36/user-services/showservice/"+id,
            type: "POST",
            success: function(data)
             {
                alert(data);
                $('#service_div').html(data);
             },
        });
}
</script>