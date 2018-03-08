<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Checkin Billings
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Checkin Billings</h3>
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
                <th><?= $this->Paginator->sort('bill_number') ?></th>
                <th><?= $this->Paginator->sort('net_amount') ?></th>
                <th><?= $this->Paginator->sort('tax_amount') ?></th>
                <th><?= $this->Paginator->sort('total_amount') ?></th>
                <th><?= $this->Paginator->sort('bill_status') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($checkinBillings as $checkinBilling): ?>
              <tr>
                <td><?= $this->Number->format($checkinBilling->id) ?></td>
                <td><?= $checkinBilling->has('checkin') ? $this->Html->link($checkinBilling->checkin->id, ['controller' => 'Checkins', 'action' => 'view', $checkinBilling->checkin->id]) : '' ?></td>
                <td><?= h($checkinBilling->bill_number) ?></td>
                <td><?= $this->Number->format($checkinBilling->net_amount) ?></td>
                <td><?= $this->Number->format($checkinBilling->tax_amount) ?></td>
                <td><?= $this->Number->format($checkinBilling->total_amount) ?></td>
                <td><?= $this->Number->format($checkinBilling->bill_status) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $checkinBilling->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkinBilling->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkinBilling->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
