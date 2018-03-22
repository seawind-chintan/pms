<section class="content-header">
  <h1>
    <?php echo __('Waterpark Issued Belt'); ?>
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
                                    <?= $waterparkIssuedBelt->has('property') ? $waterparkIssuedBelt->property->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Waterpark Ticket') ?></dt>
                                <dd>
                                    <?= $waterparkIssuedBelt->has('waterpark_ticket') ? $waterparkIssuedBelt->waterpark_ticket->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Waterpark Belt') ?></dt>
                                <dd>
                                    <?= $waterparkIssuedBelt->has('waterpark_belt') ? $waterparkIssuedBelt->waterpark_belt->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkIssuedBelt->status) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Issued Date') ?></dt>
                                <dd>
                                    <?= h($waterparkIssuedBelt->issued_date) ?>
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
