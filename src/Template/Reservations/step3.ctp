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
          <?php //pr($_SESSION) ?> 
          <div class="box-body">
            <legend class="col-form-label col-md-12 pt-0">Guest/Member Details</label></legend><hr>
            <div class="col-md-12">
              <?php
                echo $this->Form->input('member_type', ['options' => $membertypes]);
              ?>
            </div>
            <div class="col-md-6">
              <?php
               echo $this->Form->input('first_name');
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('last_name');
              ?>
            </div>
            <div class="col-md-12">
              <?php
              echo $this->Form->input('address', ['rows' => 4]);
              ?>
            </div>
            <div class="col-md-4">
              <?php
              echo $this->Form->input('country_id', ['options' => $countries]);
              ?>
            </div>
            <div class="col-md-4">
              <?php
             echo $this->Form->input('state_id', ['options' => $states]);
              ?>
            </div>
            <div class="col-md-4">
              <?php
              echo $this->Form->input('city_id', ['options' => $cities]);
              ?>
            </div>
            <div class="col-md-6">
              <?php
               echo $this->Form->input('pincode');
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('phone');
              ?>
            </div>
            <div class="col-md-6">
              <?php
               echo $this->Form->input('mobile');
              ?>
            </div>
            <div class="col-md-6">
              <?php
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
        .inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"})
        .datepicker({
            language:'en',
            format: 'yyyy-mm-dd',
            startDate: '+0d'
        });
  });
</script>
<?php $this->end(); ?>