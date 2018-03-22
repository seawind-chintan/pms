<section class="content-header">
  <h1>
    Waterpark Kot Billing
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
        <?= $this->Form->create($waterparkKotBilling, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('waterpark_kot_id', ['options' => $waterparkKots]);
            echo $this->Form->input('waterpark_belt_id', ['options' => $waterparkBelts, 'empty' => true]);
            echo $this->Form->input('restaurant_kitchen_id', ['options' => $restaurantKitchens, 'empty' => true]);
            echo $this->Form->input('waterpark_kot_no');
            echo $this->Form->input('total_amount');
            echo $this->Form->input('total_qty');
            echo $this->Form->input('total_cgst');
            echo $this->Form->input('total_sgst');
            echo $this->Form->input('bill_status');
            echo $this->Form->input('bill_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
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

        <?php
$this->Html->css([
    'AdminLTE./plugins/datepicker/datepicker3',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/input-mask/jquery.inputmask',
  'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
  'AdminLTE./plugins/datepicker/bootstrap-datepicker',
  'AdminLTE./plugins/datepicker/locales/bootstrap-datepicker.pt-BR',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    //Datemask mm/dd/yyyy
    $(".datepicker")
        .inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"})
        .datepicker({
            language:'en',
            format: 'mm/dd/yyyy'
        });
  });
</script>
<?php $this->end(); ?>
        