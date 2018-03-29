<section class="content-header">
    <h1>
        <?php echo __('Waterpark Kot'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo $back_url;?>" class=""><i class="fa fa-dashboard"></i>Back</a>
            <?php //echo $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                        <dt><?= __('Kot No') ?></dt>
                        <dd>
                            <?= $this->Number->format($waterparkKot->waterpark_kot_no) ?>
                        </dd>
                        <dt><?= __('Kot Date') ?></dt>
                        <dd>
                            <?php echo $this->Time->format($waterparkKot->created,'dd-MM-yyyy HH:mm:ss')?>
                        </dd>
                        <?php /* * ?>
                        <dt><?= __('Property') ?></dt>
                        <dd>
                            <?= $waterparkKot->has('property') ? $waterparkKot->property->name : '' ?>
                        </dd>
                        <dt><?= __('Restaurant Kitchen') ?></dt>
                        <dd>
                            <?= $waterparkKot->has('restaurant_kitchen') ? $waterparkKot->restaurant_kitchen->name : '' ?>
                        </dd>
                        <?php /* */ ?>

                        <dt><?= __('Total Qty') ?></dt>
                        <dd>
                            <?= $this->Number->format($waterparkKot->total_qty) ?>
                        </dd>
                        <dt><?= __('Total Amount') ?></dt>
                        <dd>
                            <?= $this->Number->currency($waterparkKot->total_amount,'INR') ?>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Waterpark Kot Items']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <?php if (!empty($waterparkKot->waterpark_kot_items)): ?>

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Menu Name
                                    </th>
                                    <th>
                                        Qty
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                </tr>

                                <?php
                                $i=1;
                                foreach ($waterparkKot->waterpark_kot_items as $waterparkKotItems): ?>
                                    <tr>

                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= h($waterparkKotItems->menu_name) ?>
                                        </td>
                                        <td>
                                            <?= h($waterparkKotItems->qty) ?>
                                        </td>
                                        <td>
                                            <?= $this->Number->currency($waterparkKotItems->price, 'INR') ?>
                                        </td>
                                        <td>
                                            <?= $this->Number->currency($waterparkKotItems->total_price, 'INR') ?>
                                        </td>
                                    </tr>
                                <?php
                                $i++;
                                endforeach; ?>

                            </tbody>
                        </table>

                    <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
