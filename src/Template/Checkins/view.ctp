<section class="content-header">
  <h1>
    <?php echo __('Checkin'); ?>
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
                                                                                                        <dt><?= __('Member') ?></dt>
                                <dd>
                                    <?= $checkin->has('member') ? $checkin->member->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Arrival From') ?></dt>
                                        <dd>
                                            <?= h($checkin->arrival_from) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Destination') ?></dt>
                                        <dd>
                                            <?= h($checkin->destination) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Purpose Of Visit') ?></dt>
                                        <dd>
                                            <?= h($checkin->purpose_of_visit) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Travel Agent') ?></dt>
                                        <dd>
                                            <?= h($checkin->travel_agent) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $checkin->has('property') ? $checkin->property->name : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('No Of Adult') ?></dt>
                                <dd>
                                    <?= $this->Number->format($checkin->no_of_adult) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Child') ?></dt>
                                <dd>
                                    <?= $this->Number->format($checkin->no_of_child) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($checkin->status) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Arrival Date Time') ?></dt>
                                <dd>
                                    <?= h($checkin->arrival_date_time) ?>
                                </dd>
                                                                                                                    <dt><?= __('Dept Date Time') ?></dt>
                                <dd>
                                    <?= h($checkin->dept_date_time) ?>
                                </dd>
                                                                                                                                                                                                            
                                            
                                                                        <dt><?= __('Remarks') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($checkin->remarks)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Checkin Rooms Rates']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($checkin->checkin_rooms_rates)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Checkin Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Room Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Room Rate Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    No Of Adult
                                    </th>
                                        
                                                                    
                                    <th>
                                    No Of Child
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($checkin->checkin_rooms_rates as $checkinRoomsRates): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->checkin_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->room_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->room_rate_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->no_of_adult) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($checkinRoomsRates->no_of_child) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'CheckinRoomsRates', 'action' => 'view', $checkinRoomsRates->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'CheckinRoomsRates', 'action' => 'edit', $checkinRoomsRates->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CheckinRoomsRates', 'action' => 'delete', $checkinRoomsRates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $checkinRoomsRates->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
