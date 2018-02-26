<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Checkin Rooms Rates
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Checkin Rooms Rates</h3>
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
                <th><?= $this->Paginator->sort('checkin_id') ?></th>
                <th><?= $this->Paginator->sort('room_id') ?></th>
                <th><?= $this->Paginator->sort('room_rate_id') ?></th>
                <th><?= $this->Paginator->sort('no_of_adult') ?></th>
                <th><?= $this->Paginator->sort('no_of_child') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($checkinRoomsRates as $checkinRoomsRate): ?>
              <tr>
                <td><?= $this->Number->format($checkinRoomsRate->id) ?></td>
                <td><?= $checkinRoomsRate->has('checkin') ? $this->Html->link($checkinRoomsRate->checkin->id, ['controller' => 'Checkins', 'action' => 'view', $checkinRoomsRate->checkin->id]) : '' ?></td>
                <td><?= $checkinRoomsRate->has('room') ? $this->Html->link($checkinRoomsRate->room->code, ['controller' => 'Rooms', 'action' => 'view', $checkinRoomsRate->room->id]) : '' ?></td>
                <td><?= $checkinRoomsRate->has('room_rate') ? $this->Html->link($checkinRoomsRate->room_rate->id, ['controller' => 'RoomRates', 'action' => 'view', $checkinRoomsRate->room_rate->id]) : '' ?></td>
                <td><?= $this->Number->format($checkinRoomsRate->no_of_adult) ?></td>
                <td><?= $this->Number->format($checkinRoomsRate->no_of_child) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $checkinRoomsRate->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkinRoomsRate->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkinRoomsRate->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
