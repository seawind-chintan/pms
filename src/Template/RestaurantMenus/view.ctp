<section class="content-header">
    <h1>
        <?php echo __('Menu'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info"></i>
                    <h3 class="box-title"><?php echo __('Information'); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <?php /* * ?>
                        <dt><?= __('Property') ?></dt>
                        <dd>
                            <?= $restaurantMenu->has('property') ? $restaurantMenu->property->name : '' ?>
                        </dd>
                        <?php /* */ ?>
                        <dt><?= __('Restaurant Kitchen') ?></dt>
                        <dd>
                            <?= $restaurantMenu->has('restaurant_kitchen') ? $restaurantMenu->restaurant_kitchen->name : '' ?>
                        </dd>
                        <dt><?= __('Restaurant Menu Type') ?></dt>
                        <dd>
                            <?= $restaurantMenu->has('restaurant_menu_type') ? $restaurantMenu->restaurant_menu_type->name : '' ?>
                        </dd>
                        <dt><?= __('Menu Category') ?></dt>
                        <dd>
                            <?= $menu_category_array[($restaurantMenu->menu_category)] ?>
                        </dd>
                        <dt><?= __('Code') ?></dt>
                        <dd>
                            <?= h($restaurantMenu->code) ?>
                        </dd>
                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($restaurantMenu->name) ?>
                        </dd>
                        <dt><?= __('Price') ?></dt>
                        <dd>
                            <?= $this->Number->currency($restaurantMenu->price,'INR') ?>
                        </dd>
                        <?php /* * ?>
                        <dt><?= __('Discountable') ?></dt>
                        <dd>
                            <?= $restaurantMenu->discountable;?>
                        </dd>
                        <dt><?= __('Is Home Delivery?') ?></dt>
                        <dd>
                            <?= ($restaurantMenu->is_home_delivery=='Yes')?$restaurantMenu->is_home_delivery:'No';?>
                        </dd>
                        <?php /* */ ?>
                        <dt><?= __('Description') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($restaurantMenu->description)); ?>
                        </dd>
                        <dt><?= __('Status') ?></dt>
                        <dd>
                            <?= $status_options[$restaurantMenu->status];?>
                        </dd>
                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

</section>
