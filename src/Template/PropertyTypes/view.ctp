<section class="content-header">
  <h1>
    <?php echo __('Property Type'); ?>
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
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($propertyType->name) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($propertyType->status) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                                                        <dt><?= __('Notes') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($propertyType->notes)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Properties']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($propertyType->properties)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Code
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                    
                                    <th>
                                    User
                                    </th>
                                        
                                                                    
                                    <th>
                                    Address
                                    </th>
                                        
                                                                    
                                    <th>
                                    Images
                                    </th>
                                        
                                                                    
                                    <th>
                                    Start Time
                                    </th>
                                        
                                                                    
                                    <th>
                                    End Time
                                    </th>
                                        
                                                                    
                                    <th>
                                    Sunday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Monday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Tuesday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Wednesday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Thursday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Friday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Saturday Open
                                    </th>
                                        
                                                                    
                                    <th>
                                    Notes
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($propertyType->properties as $properties): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($properties->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->code) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->user) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->address) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->images) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->start_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->end_time) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->sunday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->monday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->tuesday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->wednesday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->thursday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->friday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->saturday_open) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->notes) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($properties->status) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Properties', 'action' => 'view', $properties->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Properties', 'action' => 'edit', $properties->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Properties', 'action' => 'delete', $properties->id], ['confirm' => __('Are you sure you want to delete # {0}?', $properties->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
