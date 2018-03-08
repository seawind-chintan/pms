<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Check Ins
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Check Ins</h3>
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
                <th><?= $this->Paginator->sort('member_id', ['label' => 'Guest/Member']) ?></th>
                <th><?= $this->Paginator->sort('arrival_date_time') ?></th>
                <th><?= $this->Paginator->sort('no_of_adult') ?></th>
                <th><?= $this->Paginator->sort('no_of_child') ?></th>
                <th><?= $this->Paginator->sort('arrival_from') ?></th>
                <th><?= $this->Paginator->sort('destination') ?></th>
                <th><?= $this->Paginator->sort('checkin_status_id') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($checkins as $checkin): ?>
              <?php //pr($checkin) ?>
              <tr>
                <td><?= $checkin->has('member') ? $this->Html->link($checkin->member->first_name, ['controller' => 'Members', 'action' => 'view', $checkin->member->id]) : '' ?></td>
                <td><?= h($checkin->arrival_date_time) ?></td>
                <td><?= $this->Number->format($checkin->no_of_adult) ?></td>
                <td><?= $this->Number->format($checkin->no_of_child) ?></td>
                <td><?= h($checkin->arrival_from) ?></td>
                <td><?= h($checkin->destination) ?></td>
                <td><?= $checkin->has('checkin_status') ? $checkin->checkin_status->name : '' ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?php
                  if($checkin->checkin_status->id == 1){
                  ?>
                    <?= $this->Html->link(__('Check Out'), ['action' => 'checkout', $checkin->id], ['class'=>'btn btn-default btn-xs']) ?>
                  <?php
                  } elseif ($checkin->checkin_status->id == 2){
                    ?>
                    <?= $this->Html->link(__('Show Bill'), ['controller' => 'checkin-billings', 'action' => 'view', $checkin->checkin_billing->id], ['class'=>'btn btn-default btn-xs']) ?>
                    <?php
                  }
                  ?>
                  <?= $this->Html->link(__('View'), ['action' => 'view', $checkin->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkin->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkin->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
