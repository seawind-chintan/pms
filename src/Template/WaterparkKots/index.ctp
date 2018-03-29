<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Waterpark Kots
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Waterpark Open Kots</h3>
                    <div class="box-tools">
                        <?php /* * ?>
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                            </div>
                        </form>
                        <?php /* */ ?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <?php /* * ?>
                                <th><?= __('user_id') ?></th>
                                <th><?= __('property_id') ?></th>
                                <?php /* */ ?>

                                <th><?= __('Kot No') ?></th>
                                <th><?= __('Kitchen') ?></th>
                                <th><?= __('Quantity') ?></th>
                                <th><?= __('Amount') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($waterparkKots as $waterparkKot): ?>
                                <tr>
                                    <td><?= $this->Number->format($waterparkKot->waterpark_kot_no) ?></td>
                                    <?php /* * ?>
                                    <td><?= $waterparkKot->has('user') ? $this->Html->link($waterparkKot->user->id, ['controller' => 'Users', 'action' => 'view', $waterparkKot->user->id]) : '' ?></td>
                                    <td><?= $waterparkKot->has('property') ? $this->Html->link($waterparkKot->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkKot->property->id]) : '' ?></td>
                                    <?php /* */ ?>

                                    <td><?= $waterparkKot->has('restaurant_kitchen') ? ($waterparkKot->restaurant_kitchen->name) : '' ?></td>
                                    <td><?= $this->Number->format($waterparkKot->total_qty) ?></td>
                                    <td><?= $this->Number->currency($waterparkKot->total_amount,'INR') ?></td>
                                    <td class="actions" style="white-space:nowrap">

                                        <?php echo $this->Html->link(__('View'), ['action' => 'view', $waterparkKot->id], ['class' => 'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__('Modify'), ['action' => 'add-more/', $waterparkKot->id], ['class'=>'btn btn-info btn-xs']) ?>


                                        <?php echo $this->Html->link(__('Generate Kot'), ['action' => 'close_kot', $waterparkKot->id], ['class'=>'btn btn-info btn-xs']) ?>
                                        <?php /* * ?>
                                        <a href="<?php echo DEFAULT_URL.'waterpark-kots/close_kot/'.$waterparkKot->id;?>" class="btn btn-default"><i class="fa fa-print"></i> Generate Kot</a>
                                        <?php /* */ ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->numbers(); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->
