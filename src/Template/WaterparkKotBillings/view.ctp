<section class="content-header">
  <h1>
    <?php echo __('Waterpark Kot Billing'); ?>
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
                                    <?= $waterparkKotBilling->has('user') ? $waterparkKotBilling->user->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $waterparkKotBilling->has('property') ? $waterparkKotBilling->property->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Waterpark Kot') ?></dt>
                                <dd>
                                    <?= $waterparkKotBilling->has('waterpark_kot') ? $waterparkKotBilling->waterpark_kot->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Waterpark Belt') ?></dt>
                                <dd>
                                    <?= $waterparkKotBilling->has('waterpark_belt') ? $waterparkKotBilling->waterpark_belt->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Restaurant Kitchen') ?></dt>
                                <dd>
                                    <?= $waterparkKotBilling->has('restaurant_kitchen') ? $waterparkKotBilling->restaurant_kitchen->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Bill Status') ?></dt>
                                        <dd>
                                            <?= h($waterparkKotBilling->bill_status) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Waterpark Kot No') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkKotBilling->waterpark_kot_no) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkKotBilling->total_amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Qty') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkKotBilling->total_qty) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Cgst') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkKotBilling->total_cgst) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Sgst') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkKotBilling->total_sgst) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Bill Date') ?></dt>
                                <dd>
                                    <?= h($waterparkKotBilling->bill_date) ?>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Waterpark Kot Item Billings']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($waterparkKotBilling->waterpark_kot_item_billings)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Property Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Waterpark Kot Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Waterpark Kot Billing Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Waterpark Kot No
                                    </th>
                                        
                                                                    
                                    <th>
                                    Restaurant Kitchen Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Restaurant Menu Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Menu Code
                                    </th>
                                        
                                                                    
                                    <th>
                                    Menu Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Qty
                                    </th>
                                        
                                                                    
                                    <th>
                                    Total Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Cgst
                                    </th>
                                        
                                                                    
                                    <th>
                                    Sgst
                                    </th>
                                        
                                                                    
                                    <th>
                                    Kot Item Date
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($waterparkKotBilling->waterpark_kot_item_billings as $waterparkKotItemBillings): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->property_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->waterpark_kot_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->waterpark_kot_billing_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->waterpark_kot_no) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->restaurant_kitchen_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->restaurant_menu_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->menu_code) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->menu_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->qty) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->total_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->cgst) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->sgst) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($waterparkKotItemBillings->kot_item_date) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'WaterparkKotItemBillings', 'action' => 'view', $waterparkKotItemBillings->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'WaterparkKotItemBillings', 'action' => 'edit', $waterparkKotItemBillings->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WaterparkKotItemBillings', 'action' => 'delete', $waterparkKotItemBillings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $waterparkKotItemBillings->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
