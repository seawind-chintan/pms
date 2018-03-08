<section class="content-header">
  <h1>
    Checkin Billing
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
        <?= $this->Form->create($checkinBilling, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('checkin_id', ['options' => $checkins]);
            echo $this->Form->input('bill_number');
            echo $this->Form->input('net_amount');
            echo $this->Form->input('tax_amount');
            echo $this->Form->input('total_amount');
            echo $this->Form->input('bill_status');
            echo $this->Form->input('pay_mode');
            echo $this->Form->input('card_number');
            echo $this->Form->input('card_holder');
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

