<section class="content-header">
  <h1>
    Checkin Billing
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
        <?= $this->Form->create($checkinBilling, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('checkin_id', ['options' => $checkins, 'readonly' => true]);
            echo $this->Form->input('bill_number', ['readonly' => true]);
            echo $this->Form->input('net_amount', ['readonly' => true]);
            echo $this->Form->input('tax_amount', ['readonly' => true]);
            echo $this->Form->input('total_amount', ['readonly' => true]);
            echo $this->Form->input('bill_status', ['readonly' => true]);
            echo $this->Form->input('pay_mode', ['options' => ['cash' => 'Cash', 'card' => 'Credit Card']]);
            echo $this->Form->input('card_number', ['readonly' => true]);
            echo $this->Form->input('card_holder', ['readonly' => true]);
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
$this->Html->script([
  'AdminLTE./plugins/jQuery/jquery-2.2.3.min',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script type="text/javascript">
  
  jQuery('#pay-mode').change(function(){
    var payMode = jQuery(this).val();
    if(payMode == "cash"){
      jQuery('#card-number').attr('readonly', true);
      jQuery('#card-holder').attr('readonly', true);
    } else {
      jQuery('#card-number').attr('readonly', false);
      jQuery('#card-holder').attr('readonly', false);
    }
  });
</script>
<?php $this->end(); ?>