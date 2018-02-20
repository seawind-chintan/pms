<section class="content-header">
  <h1>
    Room Rate
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
        <?= $this->Form->create($roomRate, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('room_plan_id', ['options' => $roomPlans]);
            echo $this->Form->input('room_type_id', ['options' => $roomTypes]);
            echo $this->Form->input('room_occupancy_id', ['options' => $roomOccupancies]);
            echo $this->Form->input('rate');
            echo $this->Form->input('extra_charge');
            echo $this->Form->input('for_specific_dates', ['type' => 'checkbox']);
            
            if($roomRate->from_date) { echo $this->Form->input('from_date', ['empty' => true, 'value'=>date('Y-m-d', strtotime($roomRate->from_date)), 'default' => '', 'class' => 'from-date datepicker form-control', 'type' => 'text']); } else { echo $this->Form->input('from_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']); }

            if($roomRate->to_date) { echo $this->Form->input('to_date', ['empty' => true, 'value'=>date('Y-m-d', strtotime($roomRate->to_date)), 'default' => '', 'class' => 'to-date datepicker form-control', 'type' => 'text']); } else { echo $this->Form->input('to_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']); }
            echo $this->Form->input('min_adult');
            echo $this->Form->input('max_adult');
            echo $this->Form->input('max_child');
            echo $this->Form->input('status', ['options' => [0 => 'Draft', 1 => 'Published']]);
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
    $(".from-date")
        .inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"})
        .datepicker({
            language:'en',
            format: 'yyyy-mm-dd',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('.to-date').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('.to-date').datepicker('setStartDate', null);
        });

    $(".to-date")
        .inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"})
        .datepicker({
            language:'en',
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('changeDate', function (selected) {
           var endDate = new Date(selected.date.valueOf());
           $('.from-date').datepicker('setEndDate', endDate);
        }).on('clearDate', function (selected) {
           $('.from-date').datepicker('setEndDate', null);
        });
  });
</script>
<?php $this->end(); ?>