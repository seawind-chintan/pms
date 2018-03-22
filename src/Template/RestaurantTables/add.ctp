<section class="content-header">
  <h1>
    Restaurant Table
    <small><?= __('Add') ?></small>
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
          $session = $this->request->session();
          $select_property_id = $session->read('default_restaurant_id');

            echo $this->Form->input('property_id', ['type'=>'hidden','value'=> $select_property_id,'readonly'=>true]);
            echo $this->Form->input('start_table_no',['label' => 'Starting Table No.','value'=>$last_table_no,'readonly'=>true]);
            echo $this->Form->input('total_no_of_table');
            echo $this->Form->input('capacity');
//            echo $this->Form->input('booking_status');
            //echo $this->Form->input('status');
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