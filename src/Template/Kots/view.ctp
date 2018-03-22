<section class="content-header">
  <h1>
    <?php echo __('Kot'); ?>
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
                                                                                                        <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $kot->has('property') ? $kot->property->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Restaurant Table') ?></dt>
                                <dd>
                                    <?= $kot->has('restaurant_table') ? $kot->restaurant_table->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Steward') ?></dt>
                                        <dd>
                                            <?= h($kot->steward) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nc Kot') ?></dt>
                                        <dd>
                                            <?= h($kot->nc_kot) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Split') ?></dt>
                                        <dd>
                                            <?= h($kot->split) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Total Qty') ?></dt>
                                        <dd>
                                            <?= h($kot->total_qty) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Bill Paid') ?></dt>
                                        <dd>
                                            <?= h($kot->bill_paid) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Kot No') ?></dt>
                                <dd>
                                    <?= $this->Number->format($kot->kot_no) ?>
                                </dd>
                                                                                                                <dt><?= __('Restaurant Table Code') ?></dt>
                                <dd>
                                    <?= $this->Number->format($kot->restaurant_table_code) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Pax') ?></dt>
                                <dd>
                                    <?= $this->Number->format($kot->no_of_pax) ?>
                                </dd>
                                                                                                                <dt><?= __('Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($kot->amount) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Remark') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($kot->remark)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Kot Items']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($kot->kot_items)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Kot Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Kot No
                                    </th>
                                        
                                                                    
                                    <th>
                                    Restaurant Table Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Restaurant Waiter Id
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
                                    Qty
                                    </th>
                                        
                                                                    
                                    <th>
                                    Menu Price
                                    </th>
                                        
                                                                    
                                    <th>
                                    Remarks
                                    </th>
                                        
                                                                    
                                    <th>
                                    Bill Paid
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($kot->kot_items as $kotItems): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($kotItems->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->kot_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->kot_no) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->restaurant_table_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->restaurant_waiter_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->restaurant_kitchen_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->restaurant_menu_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->menu_code) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->menu_name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->qty) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->menu_price) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->remarks) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($kotItems->bill_paid) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'KotItems', 'action' => 'view', $kotItems->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'KotItems', 'action' => 'edit', $kotItems->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'KotItems', 'action' => 'delete', $kotItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kotItems->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
