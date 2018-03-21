<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Waterpark Tickets
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Waterpark Tickets</h3>
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
                <!--<th><?= $this->Paginator->sort('id') ?></th>-->
                <!-- <th><?= $this->Paginator->sort('property_id') ?></th> -->
                <!-- <th><?= $this->Paginator->sort('user_id') ?></th> -->
                <th><?= $this->Paginator->sort('code', ['label' => 'Ticket No']) ?></th>
                <th><?= $this->Paginator->sort('no_of_persons') ?></th>
                <th><?= $this->Paginator->sort('net_amount', ['label' => 'Customer Paid Amount']) ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkTickets as $waterparkTicket): ?>
              <tr>
                <!-- <td><?= $this->Number->format($waterparkTicket->id) ?></td> -->
                <!-- <td><?= $waterparkTicket->has('property') ? $this->Html->link($waterparkTicket->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkTicket->property->id]) : '' ?></td> -->
                <!-- <td><?= $waterparkTicket->has('user') ? $this->Html->link($waterparkTicket->user->id, ['controller' => 'Users', 'action' => 'view', $waterparkTicket->user->id]) : '' ?></td> -->
                <td><?= h($waterparkTicket->code) ?></td>
                <td><?= $this->Number->format($waterparkTicket->no_of_persons) ?></td>
                <td><?= $this->Number->format($waterparkTicket->net_amount) ?></td>
                <td><?= $this->Number->format($waterparkTicket->status) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">View for Print</button>
                  <?= $this->Html->link(__('View'), ['action' => 'view', $waterparkTicket->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkTicket->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $waterparkTicket->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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


<div class="example-modal">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ticket Preview</h4>
        </div>
        <div class="modal-body">
          <div>
            <p style="text-align:center;"><span><b>Jolly Club</b></span></p>
          </div>
          <div>
            <p><span>Ticket No <b>#32164654</b></span><span class="pull-right">Mobile No <b>987654321</b></span></p>
          </div>
          <div>
            <p><span><b>-</b></span><span class="pull-right">No of Persons <b>2</b></span></p>
          </div>
          <hr>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Print</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.example-modal -->