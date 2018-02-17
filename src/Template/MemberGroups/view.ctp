<section class="content-header">
    <h1>
        <?php echo __('Member Group'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                        <?php /* * ?>
                        <dt><?= __('User') ?></dt>
                        <dd>
                            <?= $memberGroup->has('user') ? $memberGroup->user->id : '' ?>
                        </dd>
                        <?php /* */?>
                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($memberGroup->name) ?>
                        </dd>
                        <dt><?= __('Status') ?></dt>
                        <dd>
                            <?= $status_options[$memberGroup->status]?>
                        </dd>
                        <dt><?= __('Remark') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($memberGroup->remark)); ?>
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
