<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Details
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> User Details</h3>
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
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('first_name') ?></th>
                <th><?= $this->Paginator->sort('last_name') ?></th>
                <th><?= $this->Paginator->sort('city') ?></th>
                <th><?= $this->Paginator->sort('state') ?></th>
                <th><?= $this->Paginator->sort('country') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($userDetails as $userDetail): ?>
              <tr>
                <td><?= $this->Number->format($userDetail->id) ?></td>
                <td><?= $userDetail->has('user') ? $this->Html->link($userDetail->user->id, ['controller' => 'Users', 'action' => 'view', $userDetail->user->id]) : '' ?></td>
                <td><?= h($userDetail->first_name) ?></td>
                <td><?= h($userDetail->last_name) ?></td>
                <td><?= $this->Number->format($userDetail->city) ?></td>
                <td><?= $this->Number->format($userDetail->state) ?></td>
                <td><?= $this->Number->format($userDetail->country) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $userDetail->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userDetail->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userDetail->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
