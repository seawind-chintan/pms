<section class="content-header">
  <h1>
    <?php echo __('Checkin Rooms Rate'); ?>
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
                                                                                                        <dt><?= __('Checkin') ?></dt>
                                <dd>
                                    <?= $checkinRoomsRate->has('checkin') ? $checkinRoomsRate->checkin->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Room') ?></dt>
                                <dd>
                                    <?= $checkinRoomsRate->has('room') ? $checkinRoomsRate->room->code : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Room Rate') ?></dt>
                                <dd>
                                    <?= $checkinRoomsRate->has('room_rate') ? $checkinRoomsRate->room_rate->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('No Of Adult') ?></dt>
                                <dd>
                                    <?= $this->Number->format($checkinRoomsRate->no_of_adult) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Child') ?></dt>
                                <dd>
                                    <?= $this->Number->format($checkinRoomsRate->no_of_child) ?>
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
