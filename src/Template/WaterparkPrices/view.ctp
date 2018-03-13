<section class="content-header">
  <h1>
    <?php echo __('Waterpark Price'); ?>
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
                                    <?= $waterparkPrice->has('property') ? $waterparkPrice->property->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Monday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->monday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Monday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->monday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Tuesday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->tuesday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Tuesday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->tuesday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Wednesday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->wednesday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Wednesday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->wednesday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Thursday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->thursday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Thursday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->thursday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Friday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->friday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Friday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->friday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Saturday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->saturday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Saturday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->saturday_ticket_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Sunday Total Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->sunday_total_price) ?>
                                </dd>
                                                                                                                <dt><?= __('Sunday Ticket Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkPrice->sunday_ticket_price) ?>
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
