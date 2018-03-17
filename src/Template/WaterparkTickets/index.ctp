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
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('code') ?></th>
                <th><?= $this->Paginator->sort('no_of_persons') ?></th>
                <th><?= $this->Paginator->sort('no_of_adults') ?></th>
                <th><?= $this->Paginator->sort('no_of_childs') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkTickets as $waterparkTicket): ?>
              <tr>
                <td><?= $this->Number->format($waterparkTicket->id) ?></td>
                <td><?= $waterparkTicket->has('property') ? $this->Html->link($waterparkTicket->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkTicket->property->id]) : '' ?></td>
                <td><?= $waterparkTicket->has('user') ? $this->Html->link($waterparkTicket->user->id, ['controller' => 'Users', 'action' => 'view', $waterparkTicket->user->id]) : '' ?></td>
                <td><?= h($waterparkTicket->code) ?></td>
                <td><?= $this->Number->format($waterparkTicket->no_of_persons) ?></td>
                <td><?= $this->Number->format($waterparkTicket->no_of_adults) ?></td>
                <td><?= $this->Number->format($waterparkTicket->no_of_childs) ?></td>
                <td class="actions" style="white-space:nowrap">
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
