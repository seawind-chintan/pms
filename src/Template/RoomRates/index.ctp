<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Room Rates
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Room Rates</h3>
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
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <th><?= $this->Paginator->sort('room_plan_id') ?></th>
                <th><?= $this->Paginator->sort('room_type_id') ?></th>
                <th><?= $this->Paginator->sort('room_occupancy_id') ?></th>
                <th><?= $this->Paginator->sort('rate') ?></th>
                <th><?= $this->Paginator->sort('min_adult') ?></th>
                <th><?= $this->Paginator->sort('max_adult') ?></th>
                <th><?= $this->Paginator->sort('max_child') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($roomRates as $roomRate): ?>
              <tr>
                <td><?= $roomRate->has('property') ? $this->Html->link($roomRate->property->name, ['controller' => 'Properties', 'action' => 'view', $roomRate->property->id]) : '' ?></td>
                <td><?= $roomRate->has('room_plan') ? $this->Html->link($roomRate->room_plan->name, ['controller' => 'RoomPlans', 'action' => 'view', $roomRate->room_plan->id]) : '' ?></td>
                <td><?= $roomRate->has('room_type') ? $this->Html->link($roomRate->room_type->name, ['controller' => 'RoomTypes', 'action' => 'view', $roomRate->room_type->id]) : '' ?></td>
                <td><?= $roomRate->has('room_occupancy') ? $this->Html->link($roomRate->room_occupancy->name, ['controller' => 'RoomOccupancies', 'action' => 'view', $roomRate->room_occupancy->id]) : '' ?></td>
                <td><?= $this->Number->format($roomRate->rate) ?></td>
                <td><?= $this->Number->format($roomRate->min_adult) ?></td>
                <td><?= $this->Number->format($roomRate->max_adult) ?></td>
                <td><?= $this->Number->format($roomRate->max_child) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $roomRate->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roomRate->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roomRate->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
