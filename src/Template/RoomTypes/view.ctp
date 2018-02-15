<section class="content-header">
  <h1>
    <?php echo __('Room Type'); ?>
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
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($roomType->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Slug') ?></dt>
                                        <dd>
                                            <?= h($roomType->slug) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $roomType->has('user') ? $roomType->user->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Price') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomType->price) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Rooms') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomType->total_rooms) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($roomType->status) ?>
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
