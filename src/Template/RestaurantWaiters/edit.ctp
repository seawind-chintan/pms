<section class="content-header">
  <h1>
    Restaurant Waiter
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
        <?= $this->Form->create($restaurantWaiter, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('name');
//            echo $this->Form->input('property_ids');
//            echo $this->Form->input('status');

            echo '<label for="user-id">Properties</label>';
            echo '<br>';

            if(!empty($property_data))
            {
                $property_array = explode(',',$restaurantWaiter->property_ids);
//                pr($restaurantKitchen->property_ids);
//                exit;

                foreach ($property_data as $k => $property_txt) {



                        $checked = '';
                        if (!empty($property_array) && in_array($property_txt['id'], $property_array))
                            $checked = 'checked';

                        echo $this->Form->input('property_ids[]', array(
                            'label' => $property_txt['name'],
                            'type' => 'checkbox',
                            'id' => 'textbox_' . $k,
                            'value' => $property_txt['id'],
                            $checked

                        ));
                }
            }

            echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options));
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
