<section class="content-header">
  <h1>
    Property
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
        <?= $this->Form->create($property, array('role' => 'form', 'type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('code');
            echo $this->Form->input('name');
            echo $this->Form->input('type', ['options' => $propertyTypes]);
            //echo $this->Form->input('user');
            echo $this->Form->input('address');
            echo $this->Form->input('images' , ['type' => 'file', 'multiple' => true, 'required' => false]);
            echo $this->Form->input('start_time');
            echo $this->Form->input('end_time');
            echo $this->Form->input('sunday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('monday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('tuesday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('wednesday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('thursday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('friday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('saturday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('notes');
            echo $this->Form->input('status');
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

