<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Packages
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Packages</h3>
                    <div class="box-tools">
                        <?php
                        $search_text = '';
                        if (isset($this->request->query['search']) && trim($this->request->query['search']) != '') {
                            $search_text = trim($this->request->query['search']);
                        }
                        ?>
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>" value="<?php echo trim($search_text);?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <?php /* */ ?><th><?= $this->Paginator->sort('user_id') ?></th><?php /* */ ?>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('rate') ?></th>
                                <th><?= $this->Paginator->sort('duration') ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $package): ?>
                                <tr>
                                    <td><?= $this->Number->format($package->id) ?></td>
                                    <?php /* */ ?><td><?= $package->has('user') ? $this->Html->link($package->user->username, ['controller' => 'Users', 'action' => 'view', $package->user->id]) : '' ?></td><?php /* */ ?>
                                    <td><?= h($package->name) ?></td>
                                    <td><?= h($package->rate) ?></td>
                                    <td><?= $this->Number->format($package->duration) ?></td>
                                    <td><?= $status_options[$package->status] ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $package->id], ['class' => 'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $package->id], ['class' => 'btn btn-warning btn-xs']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $package->id], ['confirm' => __('Confirm to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
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
