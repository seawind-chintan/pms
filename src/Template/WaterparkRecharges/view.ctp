<section class="content-header">
  <h1>
    <?php echo __('Waterpark Recharge'); ?>
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
                                    <?= $waterparkRecharge->has('user') ? $waterparkRecharge->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $waterparkRecharge->has('property') ? $waterparkRecharge->property->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Code') ?></dt>
                                        <dd>
                                            <?= h($waterparkRecharge->code) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkRecharge->amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkRecharge->status) ?>
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
