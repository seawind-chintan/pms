<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kots
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Kots</h3>
          <div class="box-tools">
              <?php /* * ?>
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
              <?php /* */ ?>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <th><?= __('Sr No.') ?></th>
                <th><?= ('Kot no') ?></th>
                <th><?= ('Restaurant Table') ?></th>
                <?php /* *?>
                <th><?= ('No Of Pax') ?></th>
                <th><?= ('Quantity') ?></th>
                <?php /* */?>
                <th><?= ('Amount') ?></th>
                <th><?= ('Order Date') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
            /* */
            if($kots)
            {
                $i=1;
                foreach ($kots as $kot): ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $this->Number->format($kot->kot_no) ?></td>
                    <td><?= $kot->restaurant_table_code; //$kot->has('restaurant_table') ? $this->Html->link($kot->restaurant_table->id, ['controller' => 'RestaurantTables', 'action' => 'view', $kot->restaurant_table->id]) : '' ?></td>
                    <?php /* *?>
                    <td><?= $this->Number->format($kot->no_of_pax) ?></td>
                    <td><?= h($kot->total_qty) ?></td>
                    <?php /* */?>
                    <td><?= h($kot->amount) ?></td>
                    <td><?php echo $this->Time->format($kot->modified,'dd-MM-yyyy HH:mm:ss'); ?></td>
                    <td class="actions" style="white-space:nowrap">
                        <?= $this->Html->link(__('Modify'), ['action' => 'add-more/', $kot->id], ['class'=>'btn btn-info btn-xs']) ?>
                        <?= $this->Form->postLink(__('Cancel'), ['action' => 'kotcancel', $kot->id], ['confirm' => __('Confirm to Cancel this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                        <?= $this->Html->link(__('Generate Bill'), ['action' => 'generate_bill/', $kot->restaurant_table_code], ['class'=>'btn btn-info btn-xs']) ?>
                    </td>
                  </tr>
                <?php $i++; endforeach;
            /* */
            }
            else
            {?>
                  <tr>
                      <td colspan="7">Kot Not Found</td>
                  </tr>
            <?php
            }
            ?>
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
