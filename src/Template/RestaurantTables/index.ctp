<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Restaurant Tables
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Restaurant Tables</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
                <?php /* * ?>
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
                <?php /* */ ?>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <?php /* *?>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <?php /* */?>
                <th><?php echo ('No') ?></th>
                <th><?= $this->Paginator->sort('code') ?></th>
                <th><?= $this->Paginator->sort('capacity') ?></th>

                <th><?= $this->Paginator->sort('booking_status') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            foreach ($restaurantTables as $restaurantTable): ?>
              <tr>
                <?php /* *?>
                <td><?= $this->Number->format($restaurantTable->id) ?></td>
                <td><?= $restaurantTable->has('property') ? $this->Html->link($restaurantTable->property->name, ['controller' => 'Properties', 'action' => 'view', $restaurantTable->property->id]) : '' ?></td>
                <?php /* */?>
                <td><?= $i ?></td>
                <td><?= h($restaurantTable->code) ?></td>
                <td><?= $this->Number->format($restaurantTable->capacity) ?></td>
                <td><?= $restaurant_status_array[$restaurantTable->booking_status] ?></td>
                <td><?= $status_options[$restaurantTable->status] ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?php //echo $this->Html->link(__('View'), ['action' => 'view', $restaurantTable->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurantTable->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurantTable->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
