<section class="content-header">
    <h1>
        <?php echo __('Member'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>
<style>
    .col-md-3 {
        min-height: 32px;
        display: block;
    }
    img {
        width: 100px;
    }
    col-md-6
    {
        line-height: 25px;
    }
    .dl-horizontal table tr td
    {
        padding: 5px;
        vertical-align: top;
        border:1px solid #ccc;
    }

</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info"></i>
                    <h3 class="box-title"><?php echo __('Information'); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dl-horizontal">
                        <table border="0" cellspacing="5" cellpadding="5" width="100%"  >
                            <tr>
                                <td width="20%"><strong><?= __('Package') ?></strong></td>
                                <td width="30%">
                                    <?= $member->has('package') ? $member->package->name : '' ?>
                                </td>
                                <td width="20%"><strong><?= __('Code') ?></strong></td>
                                <td width="30%">
                                    <?= h($member->code) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('First Name') ?></strong></td>
                                <td>
                                    <?= h($member->first_name) ?>
                                </td>
                                <td><strong><?= __('Last Name') ?></strong></td>
                                <td>
                                    <?= h($member->last_name) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Nick Name') ?></strong></td>
                                <td>
                                    <?= h($member->nick_name) ?>
                                </td>
                                <td><strong><?= __('Application No') ?></strong></td>
                                <td>
                                    <?= h($member->application_no) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Member Group') ?></strong></td>
                                <td>
                                    <?= $member->has('member_group') ? $member->member_group->name : '' ?>
                                </td>
                                <td><strong><?= __('Occupation') ?></strong></td>
                                <td>
                                    <?= h($member->occupation) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Organization') ?></strong></td>
                                <td>
                                    <?= h($member->organization) ?>
                                </td>
                                <td><strong><?= __('Designation') ?></strong></td>
                                <td>
                                    <?= h($member->designation) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Birth Date') ?></strong></td>
                                <td>
                                    <?php echo ($member->birth_date!='0000-00-00')?($member->birth_date):''?>
                                </td>
                                <td><strong><?= __('Anniversary Date') ?></strong></td>
                                <td>
                                    <?php echo ($member->anniversary_date!='0000-00-00')?($member->anniversary_date):''?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Blood Group') ?></strong></td>
                                <td>
                                    <?= h($member->blood_group) ?>
                                </td>
                                <td><strong><?= __('Gender') ?></strong></td>
                                <td>
                                    <?php $gender_array = array('Male', 'Female'); ?>
                                    <?= $gender_array[$member->gender] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Pancard') ?></strong></td>
                                <td>
                                    <?= h($member->pancard) ?>
                                </td>
                                <td><strong><?= __('Aadharcard') ?></strong></td>
                                <td>
                                    <?= h($member->aadharcard) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Marrital Status') ?></strong></td>
                                <td>
                                    <?php $matital_array = array('Yes', 'No'); ?>
                                    <?= $matital_array[$member->marrital_status] ?>
                                </td>
                                <td><strong><?= __('Email') ?></strong></td>
                                <td>
                                    <?= h($member->email) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Phone') ?></strong></td>
                                <td>
                                    <?= h($member->phone) ?>
                                </td>
                                <td><strong><?= __('Mobile') ?></strong></td>
                                <td>
                                    <?= h($member->mobile) ?>
                                </td>
                            </tr>
                            <tr style="height: 20px">
                                <td colspan="2"><b><u>Correspondence Details</u></b></td>
                                <td colspan="2"><b><u>Residence Details</u></b></td>
                            </tr>
                            <tr>

                                <td><strong><?= __('Address') ?></strong></td>
                                <td>
                                    <?= $this->Text->autoParagraph(h($member->cor_address)); ?>
                                </td>
                                <td><strong><?= __('Address') ?></strong></td>
                                <td>
                                    <?= $this->Text->autoParagraph(h($member->res_address)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Country') ?></strong></td>
                                <td>
                                    <?= h($member->cor_country) ?>
                                </td>
                                <td><strong><?= __('Country') ?></strong></td>
                                <td>
                                    <?= h($member->res_country) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('State') ?></strong></td>
                                <td>
                                    <?= h($member->cor_state) ?>
                                </td>
                                <td><strong><?= __('State') ?></strong></td>
                                <td>
                                    <?= h($member->res_state) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('City') ?></strong></td>
                                <td>
                                    <?= h($member->cor_city) ?>
                                </td>
                                <td><strong><?= __('City') ?></strong></td>
                                <td>
                                    <?= h($member->res_city) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Pincode') ?></strong></td>
                                <td>
                                    <?= h($member->cor_pincode) ?>
                                </td>
                                <td><strong><?= __('Pincode') ?></strong></td>
                                <td>
                                    <?= h($member->res_pincode) ?>
                                </td>
                            </tr>
                            <tr>
                                <?php /*                                 * ?>
                                  <div class="col-md-12">
                                  <div  class="col-md-3" style="padding-left: 0px;"><strong><?= __('Services') ?></strong></td>
                                  <div class="col-md-8" style="border: 0px solid red;">
                                  <?= h($member->services) ?>
                                  </td>
                                  <?php /* */ ?>
                                </td>
                                <td><strong><?= __('Discount') ?></strong></td>
                                <td>
                                    <?= $this->Number->format($member->discount) ?>
                                </td>
                                <td><strong><?= __('Status') ?></strong></td>
                                <td>
                                    <?= $member->status; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Images') ?></strong></td>
                                <td>
                                    <?php
                                    echo $this->Html->image($this->Url->build('/webroot/img/uploads/members/images/', true) . $member->images_dir . '/square_' . $member->images, array('class' => 'user-image', 'alt' => 'Image'));
                                    //echo  h($member->images)
                                    ?>

                                </td>
                                <td><strong><?= __('Remark') ?></strong></td>
                                <td>
                                    <?= $this->Text->autoParagraph(h($member->remark)); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

</section>
