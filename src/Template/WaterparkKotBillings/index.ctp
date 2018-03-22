<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Waterpark Kot Billings
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Waterpark Kot Billings</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
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
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <th><?= $this->Paginator->sort('waterpark_kot_id') ?></th>
                <th><?= $this->Paginator->sort('waterpark_belt_id') ?></th>
                <th><?= $this->Paginator->sort('restaurant_kitchen_id') ?></th>
                <th><?= $this->Paginator->sort('waterpark_kot_no') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkKotBillings as $waterparkKotBilling): ?>
              <tr>
                <td><?= $this->Number->format($waterparkKotBilling->id) ?></td>
                <td><?= $waterparkKotBilling->has('user') ? $this->Html->link($waterparkKotBilling->user->id, ['controller' => 'Users', 'action' => 'view', $waterparkKotBilling->user->id]) : '' ?></td>
                <td><?= $waterparkKotBilling->has('property') ? $this->Html->link($waterparkKotBilling->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkKotBilling->property->id]) : '' ?></td>
                <td><?= $waterparkKotBilling->has('waterpark_kot') ? $this->Html->link($waterparkKotBilling->waterpark_kot->id, ['controller' => 'WaterparkKots', 'action' => 'view', $waterparkKotBilling->waterpark_kot->id]) : '' ?></td>
                <td><?= $waterparkKotBilling->has('waterpark_belt') ? $this->Html->link($waterparkKotBilling->waterpark_belt->id, ['controller' => 'WaterparkBelts', 'action' => 'view', $waterparkKotBilling->waterpark_belt->id]) : '' ?></td>
                <td><?= $waterparkKotBilling->has('restaurant_kitchen') ? $this->Html->link($waterparkKotBilling->restaurant_kitchen->name, ['controller' => 'RestaurantKitchens', 'action' => 'view', $waterparkKotBilling->restaurant_kitchen->id]) : '' ?></td>
                <td><?= $this->Number->format($waterparkKotBilling->waterpark_kot_no) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $waterparkKotBilling->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkKotBilling->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $waterparkKotBilling->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
