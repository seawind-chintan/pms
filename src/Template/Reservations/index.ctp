<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Reservations
    <div class="pull-right"><?= $this->Html->link(__('New Reservation'), ['action' => 'wizard'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Reservations</h3>
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
                <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                <th><?= $this->Paginator->sort('member_type') ?></th>
                <!-- <th><?= $this->Paginator->sort('member_id') ?></th> -->
                <th><?= $this->Paginator->sort('first_name') ?></th>
                <th><?= $this->Paginator->sort('last_name') ?></th>
                <th><?= $this->Paginator->sort('city_id') ?></th>
                <th><?= $this->Paginator->sort('state_id') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $reservation): ?>
              <tr>
                <!-- <td><?= $this->Number->format($reservation->id) ?></td> -->
                <td><?php if($reservation->member_type == 'guest') { echo 'Guest'; } else { echo 'Member'; } ?></td>
                <!-- <td><?= $reservation->has('member') ? $this->Html->link($reservation->member->id, ['controller' => 'Members', 'action' => 'view', $reservation->member->id]) : '' ?></td> -->
                <td><?= h($reservation->first_name) ?></td>
                <td><?= h($reservation->last_name) ?></td>
                <td><?= $reservation->has('city') ? $this->Html->link($reservation->city->name, ['controller' => 'Cities', 'action' => 'view', $reservation->city->id]) : '' ?></td>
                <td><?= $reservation->has('state') ? $this->Html->link($reservation->state->name, ['controller' => 'States', 'action' => 'view', $reservation->state->id]) : '' ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?php //$this->Html->link(__('View'), ['action' => 'view', $reservation->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?php // $this->Html->link(__('Edit'), ['action' => 'wizard', $reservation->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $reservation->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
