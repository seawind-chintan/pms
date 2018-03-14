<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Waterpark Specific Prices
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Waterpark Specific Prices</h3>
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
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('single_date', ['label' => 'For Date']) ?></th>
                <th><?= $this->Paginator->sort('total_price') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($waterparkSpecificPrices as $waterparkSpecificPrice): ?>
              <tr>
                <td><?= $this->Number->format($waterparkSpecificPrice->id) ?></td>
                <td><?= $waterparkSpecificPrice->has('property') ? $this->Html->link($waterparkSpecificPrice->property->name, ['controller' => 'Properties', 'action' => 'view', $waterparkSpecificPrice->property->id]) : '' ?></td>
                <td><?php if(empty($waterparkSpecificPrice->type)) { echo "Single Date"; } else { echo "Date Range"; } ?></td>
                <td><?php if(empty($waterparkSpecificPrice->type)) { ?><?= h($waterparkSpecificPrice->single_date) ?><?php } else { ?><?= h($waterparkSpecificPrice->from_date) ?> - <?= h($waterparkSpecificPrice->to_date) ?><?php } ?></td>
                <td><?= $this->Number->format($waterparkSpecificPrice->total_price) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $waterparkSpecificPrice->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $waterparkSpecificPrice->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $waterparkSpecificPrice->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
