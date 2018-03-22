<section class="content-header">
  <h1>
    <?php echo __('Waterpark Tax'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                                                                                                        <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $waterparkTax->has('user') ? $waterparkTax->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Restaurant Menu Type') ?></dt>
                                <dd>
                                    <?= $waterparkTax->has('restaurant_menu_type') ? $waterparkTax->restaurant_menu_type->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Cgst') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTax->cgst) ?>
                                </dd>
                                                                                                                <dt><?= __('Sgst') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTax->sgst) ?>
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
