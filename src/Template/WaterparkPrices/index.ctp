<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Waterpark Prices
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Waterpark Prices</h3>
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
                <th><?= $this->Paginator->sort('monday_total_price') ?></th>
                <th><?= $this->Paginator->sort('tuesday_total_price') ?></th>
                <th><?= $this->Paginator->sort('wednesday_total_price') ?></th>
                <th><?= $this->Paginator->sort('thursday_total_price') ?></th>
                <th><?= $this->Paginator->sort('friday_total_price') ?></th>
                <th><?= $this->Paginator->sort('saturday_total_price') ?></th>
                <th><?= $this->Paginator->sort('sunday_total_price') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkPrices as $waterparkPrice): ?>
              <tr>
                <td><?= $this->Number->format($waterparkPrice->id) ?></td>
                <td><?= $waterparkPrice->has('property') ? $this->Html->link($waterparkPrice->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkPrice->property->id]) : '' ?></td>
                <td><?= $this->Number->format($waterparkPrice->monday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->tuesday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->wednesday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->thursday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->friday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->saturday_total_price) ?></td>
                <td><?= $this->Number->format($waterparkPrice->sunday_total_price) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $waterparkPrice->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkPrice->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $waterparkPrice->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
