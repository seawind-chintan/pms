<section class="content-header">
  <h1>
    <?php echo __('Waterpark Specific Price'); ?>
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
                                                                                                        <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $waterparkSpecificPrice->has('property') ? $waterparkSpecificPrice->property->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Type') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkSpecificPrice->type) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkSpecificPrice->total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkSpecificPrice->ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkSpecificPrice->status) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Single Date') ?></dt>
                                <dd>
                                    <?= h($waterparkSpecificPrice->single_date) ?>
                                </dd>
                                                                                                                    <dt><?= __('From Date') ?></dt>
                                <dd>
                                    <?= h($waterparkSpecificPrice->from_date) ?>
                                </dd>
                                                                                                                    <dt><?= __('To Date') ?></dt>
                                <dd>
                                    <?= h($waterparkSpecificPrice->to_date) ?>
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
