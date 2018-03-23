<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Waterpark Issued Belts
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Waterpark Issued Belts</h3>
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
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <th><?= $this->Paginator->sort('ticket_id') ?></th>
                <th><?= $this->Paginator->sort('belt_id') ?></th>
                <th><?= $this->Paginator->sort('issued_date') ?></th>
                <!-- <th><?= $this->Paginator->sort('status') ?></th> -->
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkIssuedBelts as $waterparkIssuedBelt): ?>
              <tr>
                <!-- <td><?= $this->Number->format($waterparkIssuedBelt->id) ?></td> -->
                <td><?= $waterparkIssuedBelt->has('property') ? $this->Html->link($waterparkIssuedBelt->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkIssuedBelt->property->id]) : '' ?></td>
                <td><?= $waterparkIssuedBelt->has('waterpark_ticket') ? '#'.$this->Html->link($waterparkIssuedBelt->waterpark_ticket->code, ['controller' => 'WaterparkTickets', 'action' => 'view', $waterparkIssuedBelt->waterpark_ticket->id]) : '' ?></td>
                <td><?= $waterparkIssuedBelt->has('waterpark_belt') ? $this->Html->link($waterparkIssuedBelt->waterpark_belt->code, ['controller' => 'WaterparkBelts', 'action' => 'view', $waterparkIssuedBelt->waterpark_belt->id]) : '' ?></td>
                <td><?= h($waterparkIssuedBelt->issued_date) ?></td>
                <!-- <td><?= $this->Number->format($waterparkIssuedBelt->status) ?></td> -->
                <td class="actions" style="white-space:nowrap">
                  <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $waterparkIssuedBelt->id], ['class'=>'btn btn-info btn-xs']) ?> -->
                  <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkIssuedBelt->id], ['class'=>'btn btn-warning btn-xs']) ?> -->
                  <?= $this->Form->postLink(__('Close'), ['action' => 'close', $waterparkIssuedBelt->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
