<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Menus List
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Restaurant Menus</h3>
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
                <th><?= $this->Paginator->sort('Sr No') ?></th>
                <?php /* * ?><th><?= $this->Paginator->sort('property_id') ?></th><?php /* */ ?>
                <th><?= $this->Paginator->sort('restaurant_kitchen_id','Kitchen') ?></th>
                <th><?= $this->Paginator->sort('restaurant_menu_type_id','Menu Type') ?></th>
                <th><?= $this->Paginator->sort('menu_category','Category') ?></th>
                <th><?= $this->Paginator->sort('code') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('price') ?></th>
                <th><?= ('status') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
            $i=(isset($this->request->query['page']) && $this->request->query['page']>1)?($limit*($this->request->query['page']-1))+1:1;

            foreach ($restaurantMenus as $restaurantMenu): ?>
              <tr>
                <td><?= $i ?></td>
<!--                <td><?= $this->Number->format($restaurantMenu->id) ?></td>-->
                <?php /* * ?><td><?= $restaurantMenu->has('property') ? $this->Html->link($restaurantMenu->property->name, ['controller' => 'Properties', 'action' => 'view', $restaurantMenu->property->id]) : '' ?></td><?php /* */ ?>
                <td><?= $restaurantMenu->has('restaurant_kitchen') ? $this->Html->link($restaurantMenu->restaurant_kitchen->name, ['controller' => 'RestaurantKitchens', 'action' => 'view', $restaurantMenu->restaurant_kitchen->id]) : '' ?></td>
                <td><?= $restaurantMenu->has('restaurant_menu_type') ? $this->Html->link($restaurantMenu->restaurant_menu_type->name, ['controller' => 'RestaurantMenuTypes', 'action' => 'view', $restaurantMenu->restaurant_menu_type->id]) : '' ?></td>
                <td><?= $menu_category_array[$restaurantMenu->menu_category] ?></td>
                <td><?= h($restaurantMenu->code) ?></td>
                <td><?= h($restaurantMenu->name) ?></td>
                <td><?= $this->Number->currency($restaurantMenu->price,'INR') ?></td>
                <td><?= $status_options[$restaurantMenu->status] ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $restaurantMenu->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurantMenu->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurantMenu->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php
            $i++;
            endforeach;
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
