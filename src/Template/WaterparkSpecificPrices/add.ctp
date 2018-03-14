<section class="content-header">
  <h1>
    Waterpark Specific Price
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
        <?= $this->Form->create($waterparkSpecificPrice, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('type', ['options' => ['Single Day', 'Date Range']]);
            
            echo $this->Form->input('single_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="row" id="single_date_selector"><div class="input {{type}}{{required}} col-md-12">{{content}}</div></div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-12">{{content}}{{error}}</div></div>']]);
            
            echo $this->Form->input('from_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="row" id="date_range_selector"><div class="input {{type}}{{required}} col-md-6">{{content}}</div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div>']]);

            echo $this->Form->input('to_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text', 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);
            
            echo $this->Form->input('total_price', ['templates' => ['inputContainer' => '<div class="row" id="date_range_selector"><div class="input {{type}}{{required}} col-md-6">{{content}}</div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div>']]);
            
            echo $this->Form->input('ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);
            
            echo $this->Form->input('status', ['options' => ['Draft', 'Published']]);
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

    //alert($("#type").val());
    selectDateType($("#type").val());

    function selectDateType(selectedType){
      //alert(selectedType);
      if(selectedType == "0"){
        $("#single_date_selector").show();
        $("#date_range_selector").hide();
      } else {
        $("#single_date_selector").hide();
        $("#date_range_selector").show();
      }
    }

    $("#type").change(function(){
      //alert($(this).val());
      selectDateType($(this).val());
    });

    $("#single-date")
        .inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"})
        .datepicker({
            language:'en',
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '+0d'
        })

    //Datemask mm/dd/yyyy
    $("#from-date")
        .inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"})
        .datepicker({
            language:'en',
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '+0d'
        }).on('changeDate', function(){
    // set the "toDate" start to not be later than "fromDate" ends:
    $('#to-date').datepicker('setStartDate', new Date($(this).val()));
});

    $('#to-date').inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"}).datepicker({
        language:'en',
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '+0d'
    // update "fromDate" defaults whenever "toDate" changes
    }).on('changeDate', function(){
        // set the "fromDate" end to not be later than "toDate" starts:
        $('#from-date').datepicker('setEndDate', new Date($(this).val()));
    });

  });
</script>
<?php $this->end(); ?>