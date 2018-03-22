<section class="content-header">
    <h1>
        Restaurant Table Booking
        <small><?= __('Add') ?></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                <?= $this->Form->create($restaurantTableBooking, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php

//                    echo $this->Form->input('property_id');
                    echo $this->Form->input('property_id', ['options' => $properties,'readonly'=>true,'label' => 'Restaurant']);
//                    echo $this->Form->input('property_id', ['options' => $properties,'type'=>'hidden']);
//                    echo $this->Form->input('restaurant_table_ids');

                    //echo
                    $select_table_no = (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]!='')?$this->request->params['pass'][0]:'';
//                    pr($this->request);
//                    exit;

                    echo $this->Form->input('restaurant_table_ids', ['options' => $table_array,'label' => 'Select Tables','multiple'=>'true','value'=>array($select_table_no)]);
                    echo $this->Form->input('booking_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text','value'=>date('d-m-Y')]);
                    echo $this->Form->input('booking_time',['value'=>date('H:i:s')]);
                    echo $this->Form->input('name');
                    echo $this->Form->input('book_by');
                    echo $this->Form->input('email');
                    echo $this->Form->input('address');
                    echo $this->Form->input('mobile');
                    echo $this->Form->input('no_of_pax');
                    echo $this->Form->input('remarks');
                    echo $this->Form->input('booking_status', array('class' => 'form-control', 'options' => $restaurant_booking_status_array));
//                    echo $this->Form->input('advanced_payment');
//                    echo $this->Form->input('status');
                    echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options));
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
        ], ['block' => 'css']);

$this->Html->script([
    'AdminLTE./plugins/input-mask/jquery.inputmask',
    'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
    'AdminLTE./plugins/datepicker/bootstrap-datepicker',
    'AdminLTE./plugins/datepicker/locales/bootstrap-datepicker.pt-BR',
        ], ['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
        //Datemask mm/dd/yyyy
        $(".datepicker")
            .inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"})
            .datepicker({
                language: 'en',
                format: 'dd-mm-yyyy',
                startDate: '+0d', //For disable future date
            });
    });
</script>
<?php $this->end(); ?>
