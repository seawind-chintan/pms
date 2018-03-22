<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Waterpark Taxes
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Waterpark Taxes</h3>
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
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('user_id') ?></th>
                                <?php /* */ ?>
                                <th><?= __('Sr No.') ?></th>
                                <th><?= __('Menu Type') ?></th>
                                <th><?= __('CGST') ?></th>
                                <th><?= __('SGST') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            foreach ($waterparkTaxes as $waterparkTax): ?>
                                <tr>
                                    <?php /* * ?>
                                    <td><?= $this->Number->format($waterparkTax->id) ?></td>
                                    <td><?= $waterparkTax->has('user') ? $this->Html->link($waterparkTax->user->id, ['controller' => 'Users', 'action' => 'view', $waterparkTax->user->id]) : '' ?></td>
                                    <?php /* */ ?>
                                    <td><?= $i ?></td>
                                    <td><?= $waterparkTax->has('restaurant_menu_type') ? $this->Html->link($waterparkTax->restaurant_menu_type->name, ['controller' => 'RestaurantMenuTypes', 'action' => 'view', $waterparkTax->restaurant_menu_type->id]) : '' ?></td>
                                    <td><?= $this->Number->format($waterparkTax->cgst) ?></td>
                                    <td><?= $this->Number->format($waterparkTax->sgst) ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?php //echo $this->Html->link(__('View'), ['action' => 'view', $waterparkTax->id], ['class'=>'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkTax->id], ['class' => 'btn btn-warning btn-xs']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $waterparkTax->id], ['confirm' => __('Confirm to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                    </td>
                                </tr>
                            <?php
                            $i++;
                            endforeach; ?>
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
