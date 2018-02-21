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
            <legend class="col-form-label col-md-12 pt-0">Payment Details<span class="pull-right"><?php
            
            $total_guests = (int) $wizardData['step1']['no_of_adult'] + (int) $wizardData['step1']['no_of_child'];
            $total_guests_title = ((!empty($wizardData['step1']['no_of_child'])) ? $wizardData['step1']['no_of_adult'].' Adult(s),'.$wizardData['step1']['no_of_child'].' Child(s)' : $wizardData['step1']['no_of_adult'].' Adult(s)' );
            

            $total_night_title = date('d-m-Y', strtotime($wizardData['step1']['start_date'])).' to '.date('d-m-Y', strtotime($wizardData['step1']['end_date']));
            $date1 = new DateTime($wizardData['step1']['start_date']);
            $date2 = new DateTime($wizardData['step1']['end_date']);
            // this calculates the diff between two dates, which is the number of nights
            $numberOfNights= $date2->diff($date1)->format("%a");

            $room_rate_arr = $wizardData['step2']['select_room_rate'];
            $total_room_rates = 0;
            foreach ($room_rate_arr as $room_rate_data) {
                $total_room_rates += (float) $room_rate_data;
            }

            $total_room_rates = $total_room_rates * $numberOfNights;

            echo ucwords($wizardData['step1']['reservation_type']).' for <b title="'.$total_night_title.'">'.$numberOfNights.'</b> nights , <b title="'.$total_guests_title.'">'.$total_guests.'</b> guest(s) , <i class="fa fa-rupee"></i><b>'.$total_room_rates.'</b> total cost';
            ?></span></legend><hr>
            <div class="col-md-12">
              <?php
                echo $this->Form->input('comments', ['rows' => 8]);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('rate', ['value' => $total_room_rates, 'readonly' => true]);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('discount');
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->input('total_cost', ['value' => $total_room_rates, 'readonly' => true]);
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

        jQuery('#discount').change(function(){
          //alert(jQuery('#rate').val());
          //alert(jQuery('#discount').val() * 100);
          var newRate = (jQuery('#rate').val()) - ( jQuery('#discount').val() * 100 );
          jQuery('#total-cost').val(newRate);
        });
  });
</script>
<?php $this->end(); ?>