<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kitchens List
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Kitchens</h3>
          <div class="box-tools">
            <?php
            $search_text = '';
            if(isset($this->request->query['search']) && trim($this->request->query['search'])!='')
            {
                $search_text = trim($this->request->query['search']);
            }
            ?>
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>" value="<?php echo trim($search_text);?>">
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
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= ('property') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($restaurantKitchens as $restaurantKitchen):

                $property_ids_ar = explode(',',$restaurantKitchen->property_ids);
                $pro_data_ar = array();
                if(!empty($property_ids_ar))
                {
                    for($i=0;$i<count($property_ids_ar);$i++)
                    {
                        $pro_data_ar[] = $property_data[$property_ids_ar[$i]];
                    }
                    $property_list = implode(', ',$pro_data_ar);
                }
                ?>
              <tr>
                <td><?= $this->Number->format($restaurantKitchen->id) ?></td>
                <td><?= h($restaurantKitchen->name) ?></td>
                <td><?= $property_list;?></td>
                <td><?= $status_options[$restaurantKitchen->status] ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?php //echo $this->Html->link(__('View'), ['action' => 'view', $restaurantKitchen->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurantKitchen->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurantKitchen->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
