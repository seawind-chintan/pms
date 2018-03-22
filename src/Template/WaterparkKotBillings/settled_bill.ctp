<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Waterpark Bills
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Waterpark Settled Bills</h3>
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
                                <th><?= __('Kot No') ?></th>
                                <th><?= __('Kitchen') ?></th>
                                <th><?= __('Amount') ?></th>
                                <th><?= __('Tax') ?></th>
                                <th><?= __('Total Amount') ?></th>
                                <th><?= __('Belt Code') ?></th>
                                <th><?= __('Date') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($waterparkKotBillings as $waterparkKotbill): ?>
                                <tr>
                                    <td><?= $this->Number->format($waterparkKotbill->waterpark_kot_no) ?></td>
                                    
                                    <td><?= $waterparkKotbill->has('restaurant_kitchen') ? ($waterparkKotbill->restaurant_kitchen->name) : '' ?></td>
                                    <td><?= $total_amount = $this->Number->precision($waterparkKotbill->total_amount,2) ?></td>
                                    <td><?= $tax_amount = $this->Number->precision($waterparkKotbill->total_cgst + $waterparkKotbill->total_sgst,2) ?></td>

                                    <td><?= $this->Number->precision($total_amount + $tax_amount,2) ?></td>

                                    <td>
                                        <?php echo $this->Time->format($waterparkKotbill->created, 'dd-MM-yyyy HH:mm:ss') ?>
                                    </td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?php echo $this->Html->link(__('Pay Bill'), ['controller'=>'waterpark-kot-billings', 'action' => 'bill_data/', $waterparkKotbill->id], ['class'=>'btn btn-info btn-xs']) ?>
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

