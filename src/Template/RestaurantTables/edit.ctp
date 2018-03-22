<section class="content-header">
  <h1>
    Restaurant Table
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
        <?= $this->Form->create($restaurantTable, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
//            echo $this->Form->input('property_id', ['options' => $properties]);
          $session = $this->request->session();
          $select_property_id = $session->read('default_restaurant_id');
            echo $this->Form->input('property_id', ['type'=>'hidden','value'=> $select_property_id,'readonly'=>true]);
            echo $this->Form->input('code',['readonly'=>true]);
            echo $this->Form->input('capacity');
            //echo $this->Form->input('booking_status');
            echo $this->Form->input('booking_status', array('label' => 'Booking Status', 'class' => 'form-control', 'options' => $restaurant_status_array));
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

