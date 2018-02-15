<section class="content-header">
  <h1>
    <?php echo __('User Detail'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

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
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $userDetail->has('user') ? $userDetail->user->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('First Name') ?></dt>
                                        <dd>
                                            <?= h($userDetail->first_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Last Name') ?></dt>
                                        <dd>
                                            <?= h($userDetail->last_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Pincode') ?></dt>
                                        <dd>
                                            <?= h($userDetail->pincode) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('City') ?></dt>
                                <dd>
                                    <?= $this->Number->format($userDetail->city) ?>
                                </dd>
                                                                                                                <dt><?= __('State') ?></dt>
                                <dd>
                                    <?= $this->Number->format($userDetail->state) ?>
                                </dd>
                                                                                                                <dt><?= __('Country') ?></dt>
                                <dd>
                                    <?= $this->Number->format($userDetail->country) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Address') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($userDetail->address)); ?>
                            </dd>
                                                    <dt><?= __('Profile Pic') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($userDetail->profile_pic)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
