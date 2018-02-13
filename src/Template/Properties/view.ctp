<section class="content-header">
  <h1>
    <?php echo __('Property'); ?>
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
                                                                                                                <dt><?= __('Code') ?></dt>
                                        <dd>
                                            <?= h($property->code) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($property->name) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Type') ?></dt>
                                <dd>
                                    <?= $property->has('Type') ? $property->Type->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->user) ?>
                                </dd>
                                                                                                                <dt><?= __('Sunday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->sunday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Monday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->monday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Tuesday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->tuesday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Wednesday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->wednesday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Thursday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->thursday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Friday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->friday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Saturday Open') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->saturday_open) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($property->status) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Start Time') ?></dt>
                                <dd>
                                    <?= h($property->start_time) ?>
                                </dd>
                                                                                                                    <dt><?= __('End Time') ?></dt>
                                <dd>
                                    <?= h($property->end_time) ?>
                                </dd>
                                                                                                                                                                                                            
                                            
                                                                        <dt><?= __('Address') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($property->address)); ?>
                            </dd>
                                                    <dt><?= __('Images') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($property->images)); ?>
                            </dd>
                                                    <dt><?= __('Notes') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($property->notes)); ?>
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
