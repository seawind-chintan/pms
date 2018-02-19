<section class="content-header">
  <h1>
    <?php echo __('Room Rate'); ?>
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
                                    <?= $roomRate->has('user') ? $roomRate->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $roomRate->has('property') ? $roomRate->property->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Room Plan') ?></dt>
                                <dd>
                                    <?= $roomRate->has('room_plan') ? $roomRate->room_plan->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Room Type') ?></dt>
                                <dd>
                                    <?= $roomRate->has('room_type') ? $roomRate->room_type->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Room Occupancy') ?></dt>
                                <dd>
                                    <?= $roomRate->has('room_occupancy') ? $roomRate->room_occupancy->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Rate') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->rate) ?>
                                </dd>
                                                                                                                <dt><?= __('Extra Charge') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->extra_charge) ?>
                                </dd>
                                                                                                                <dt><?= __('For Specific Dates') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->for_specific_dates) ?>
                                </dd>
                                                                                                                <dt><?= __('Min Adult') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->min_adult) ?>
                                </dd>
                                                                                                                <dt><?= __('Max Adult') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->max_adult) ?>
                                </dd>
                                                                                                                <dt><?= __('Max Child') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->max_child) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomRate->status) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('From Date') ?></dt>
                                <dd>
                                    <?= h($roomRate->from_date) ?>
                                </dd>
                                                                                                                    <dt><?= __('To Date') ?></dt>
                                <dd>
                                    <?= h($roomRate->to_date) ?>
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
