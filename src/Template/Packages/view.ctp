<section class="content-header">
    <h1>
        <?php echo __('Package'); ?>
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
                        <dt><?= __('User') ?></dt>
                        <dd>
                            <?= $package->user->username;?>
                        </dd>
                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($package->name) ?>
                        </dd>
                        <dt><?= __('Rate') ?></dt>
                        <dd>
                            <?= h($package->rate) ?>
                        </dd>


                        <dt><?= __('Duration') ?></dt>
                        <dd>
                            <?= $this->Number->format($package->duration) ?>
                        </dd>
                        <dt><?= __('Status') ?></dt>
                        <dd>
                            <?= $status_options[$package->status] ?>
                        </dd>



                        <dt><?= __('Description') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($package->description)); ?>
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
