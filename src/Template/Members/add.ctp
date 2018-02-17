<section class="content-header">
    <h1>
        Member
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
                <?= $this->Form->create($member, array('role' => 'form','type' => 'file')) ?>
                <div class="box-body">
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('package_id', ['options' => $packages]);
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('code');
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
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('nick_name');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('application_no');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('member_group_id', ['options' => $memberGroups]);
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('occupation');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('organization');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('designation');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('birth_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('anniversary_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('blood_group');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('gender', array('label' => 'Gender', 'class' => 'form-control', 'options' => array('Male','Female')));
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('pancard');
                    echo $this->Form->input('aadharcard');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('remark');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('marrital_status', array('label' => 'Marrital Status', 'class' => 'form-control', 'options' => array('Yes','No')));
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php

                    echo $this->Form->input('email');
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

                    <div class="col-md-6"><b>Correspondence</b></div>
                    <div class="col-md-6"><b>Residence</b></div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('cor_address',array('label' => 'Address'));
                    echo $this->Form->input('cor_country', array('label'=>'Select Country','class' => 'form-control', 'options' => $countries));
                    echo $this->Form->input('cor_state', array('onChange'=>'showCities(this.value,"cor")','label'=>'Select State','class' => 'form-control', 'options' => $states));
                    echo $this->Form->input('cor_city', array('label'=>'Select City','class' => 'form-control', 'options' => $cities));
                    echo $this->Form->input('cor_pincode',array('label' => 'Pincode'));
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('res_address',array('label' => 'Address'));
                    echo $this->Form->input('res_country', array('label'=>'Select Country','class' => 'form-control', 'options' => $countries));
                    echo $this->Form->input('res_state', array('onChange'=>'showCities(this.value,"res")','label'=>'Select State','class' => 'form-control', 'options' => $states));
                    echo $this->Form->input('res_city', array('label'=>'Select City','class' => 'form-control', 'options' => $cities));
                    echo $this->Form->input('res_pincode',array('label' => 'Pincode'));
                    ?>
                    </div>
                    <div class="col-md-12">
                    <?php

                    echo $this->Form->input('images', ['type' => 'file', 'required' => 'false']);
                    ?>
                    </div>
                    <?php /* * ?>
                    <div class="col-md-12">
                    <?php
                    //echo $this->Form->input('services');

                    echo '<label for="user-id">Services</label>';
                    echo '<br>';

                    foreach ($services_arr as $k => $service_txt) {

                        $t = 0;
                        if (!empty($service_txt['child'])) {
                            //echo '<br>';
                            echo $service_txt['name'];

                            foreach ($service_txt['child'] as $sub_id => $sub_service_txt) {
                                $checked = '';
                                if (!empty($service_array) && in_array($sub_id, $service_array))
                                    $checked = 'checked';

                                echo $this->Form->input('services[]', array(
                                    'label' => $sub_service_txt['name'],
                                    'type' => 'checkbox',
                                    'id' => 'textbox_' . $sub_id,
                                    'value' => $sub_service_txt['id'],
                                    $checked

                                ));
                            }
                        }
                    }
                    ?>

                    </div>
                    <?php /* */ ?>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('discount');
                    ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                    echo $this->Form->input('status', array('label' => 'Status', 'options' => $status_options));
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
//        //Datemask mm/dd/yyyy
//        $(".datepicker")
//                .inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"})
//                .datepicker({
//                    language: 'en',
//                    format: 'mm/dd/yyyy'
//                });
    });
</script>
<?php $this->end(); ?>
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
        /* *
        $(".datepicker")
            .inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"})
            .datepicker({
                language: 'en',
                format: 'mm/dd/yyyy',
                endDate: '+0d',
            });
        /* */

        /* */
        $(".datepicker")
            .inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"})
            .datepicker({
                language: 'en',
                format: 'dd-mm-yyyy',
                endDate: '+0d', //For disable future date
            });
        /* */
    });
</script>

<script type="text/javascript">
function showCities(id,check_type)
{
    //alert(check_type);
    $('#'+check_type+'-city').parent().attr('id', check_type+"city-area")
    $.ajax({
            url: "<?=DEFAULT_URL?>states/getcities/"+id+"/"+check_type+'_city',
            type: "POST",
            /*data: dataString,*/
            success: function(data)
             {
              //alert(data);
              $('#'+check_type+'city-area').html(data);
             },
        });
}
</script>
<?php $this->end(); ?>
