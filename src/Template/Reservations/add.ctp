<section class="content-header">
  <h1>
    Reservation
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
        <?= $this->Form->create($reservation, array('role' => 'form')) ?>
          <div class="box-body">
            <legend class="col-form-label col-md-12 pt-0">Reservation Details</label></legend><hr>
            <div class="col-md-6">
              <?php
                echo $this->Form->input('reservation_type', ['options' => $reservationtypes]);
                echo $this->Form->input('start_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
                echo $this->Form->input('end_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
                echo $this->Form->input('no_of_adult');
                echo $this->Form->input('no_of_child');
                echo $this->Form->input('no_of_rooms', ['min' => 1, 'max'=>$totalRooms]);
                echo $this->Form->input('comments', ['rows' => 8]);
                echo $this->Form->input('rate');
                echo $this->Form->input('discount');
                echo $this->Form->input('total_cost');
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('member_type', ['options' => $membertypes]);
              //echo $this->Form->input('member_id', ['options' => $members]);
              echo $this->Form->input('first_name');
              echo $this->Form->input('last_name');
              echo $this->Form->input('address', ['rows' => 4]);
              echo $this->Form->input('city_id', ['options' => $cities]);
              echo $this->Form->input('state_id', ['options' => $states]);
              echo $this->Form->input('country_id', ['options' => $countries]);
              echo $this->Form->input('pincode');
              echo $this->Form->input('phone');
              echo $this->Form->input('mobile');
              echo $this->Form->input('email');
              ?>
            </div>
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
            format: 'mm/dd/yyyy',
            startDate: '+0d'
        });
  });
</script>
<?php $this->end(); ?>