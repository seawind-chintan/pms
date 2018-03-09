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
                <th><?= $this->Paginator->sort('first_name', ['label' => 'Guest/Member']) ?></th>
                <th><?= $this->Paginator->sort('mobile', ['label' => 'Guest Contact']) ?></th>
                <th><?= $this->Paginator->sort('start_date', ['label' => 'Booked For Date']) ?></th>
                <th><?= $this->Paginator->sort('property.name', ['label' => 'Booked For Property']) ?></th>
                <th>Packages Selected</th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $reservation): ?>
              <tr>
                <!-- <td><?= $reservation->has('member') ? $this->Html->link($reservation->member->id, ['controller' => 'Members', 'action' => 'view', $reservation->member->id]) : '' ?></td> -->
                <td><?php //pr($reservation); ?><?= h($reservation->first_name) ?> <?= h($reservation->last_name) ?> (<?php if($reservation->member_type == 'guest') { echo 'Guest'; } else { echo 'Member'; } ?>)</td>
                <td><?= h($reservation->mobile) ?></td>
                <td><?= h($reservation->start_date) ?> to <?= h($reservation->end_date) ?></td>
                <td><?= h($reservation->property->name) ?></td>
                <td>
                  <?php
                  $pkgs_arr = array();
                  foreach ($reservation->reservation_rates as $rates_key => $rates_value) {
                    //pr($rates_value);
                    $pkgs_arr[] = $rates_value->room_rate->room_occupancy->name.'-'.$rates_value->room_rate->room_type->name.'-'.$rates_value->room_rate->room_plan->name;
                  }
                  echo implode('<br>', $pkgs_arr);
                  ?>  
                </td>
                <td class="actions" style="white-space:nowrap">
                  <?php
                  //var_dump(strtotime($reservation->start_date));
                  //var_dump(strtotime(date('Y-m-d')));
                  //var_dump(strtotime($reservation->end_date));
                  ?>
                  <?php if(strtotime(date('Y-m-d')) >= strtotime($reservation->start_date) && strtotime(date('Y-m-d')) <= strtotime($reservation->end_date)) { ?>
                  <?= $this->Html->link(__('Check In Guest'), ['controller' => 'checkins','action' => 'add', 'reservation_id' => $reservation->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?php } ?>
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
