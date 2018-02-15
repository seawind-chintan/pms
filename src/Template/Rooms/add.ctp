<section class="content-header">
  <h1>
    Room
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
        <?= $this->Form->create($room, array('role' => 'form', 'type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('name');
            //echo $this->Form->input('slug');
            echo $this->Form->input('number');
            echo $this->Form->input('code');
            echo $this->Form->input('type', ['options' => $roomtypes]);
            echo $this->Form->input('images[]', ['label' => 'Room Images', 'type' => 'file', 'multiple' => 'true']);
            echo $this->Form->input('extra_adult_rate');
            echo $this->Form->input('extra_child_rate');
            echo $this->Form->input('room_occupancy');
            echo $this->Form->input('description');
            //echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('status', ['options' => $status_options]);
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

