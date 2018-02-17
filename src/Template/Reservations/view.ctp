<section class="content-header">
  <h1>
    <?php echo __('Reservation'); ?>
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
                                                                                                                <dt><?= __('Member Type') ?></dt>
                                        <dd>
                                            <?= h($reservation->member_type) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Member') ?></dt>
                                <dd>
                                    <?= $reservation->has('member') ? $reservation->member->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('First Name') ?></dt>
                                        <dd>
                                            <?= h($reservation->first_name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Last Name') ?></dt>
                                        <dd>
                                            <?= h($reservation->last_name) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('City') ?></dt>
                                <dd>
                                    <?= $reservation->has('city') ? $reservation->city->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('State') ?></dt>
                                <dd>
                                    <?= $reservation->has('state') ? $reservation->state->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Country') ?></dt>
                                <dd>
                                    <?= $reservation->has('country') ? $reservation->country->name : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Pincode') ?></dt>
                                        <dd>
                                            <?= h($reservation->pincode) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                        <dd>
                                            <?= h($reservation->phone) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Mobile') ?></dt>
                                        <dd>
                                            <?= h($reservation->mobile) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email') ?></dt>
                                        <dd>
                                            <?= h($reservation->email) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Reservation Type') ?></dt>
                                        <dd>
                                            <?= h($reservation->reservation_type) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('No Of Adult') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->no_of_adult) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Child') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->no_of_child) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Rooms') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->no_of_rooms) ?>
                                </dd>
                                                                                                                <dt><?= __('Rate') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->rate) ?>
                                </dd>
                                                                                                                <dt><?= __('Discount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->discount) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Cost') ?></dt>
                                <dd>
                                    <?= $this->Number->format($reservation->total_cost) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Start Date') ?></dt>
                                <dd>
                                    <?= h($reservation->start_date) ?>
                                </dd>
                                                                                                                    <dt><?= __('End Date') ?></dt>
                                <dd>
                                    <?= h($reservation->end_date) ?>
                                </dd>
                                                                                                                                                                                                            
                                            
                                                                        <dt><?= __('Address') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($reservation->address)); ?>
                            </dd>
                                                    <dt><?= __('Comments') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($reservation->comments)); ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Reservation Rooms']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($reservation->reservation_rooms)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Reservation Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Room Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($reservation->reservation_rooms as $reservationRooms): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($reservationRooms->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reservationRooms->reservation_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($reservationRooms->room_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'ReservationRooms', 'action' => 'view', $reservationRooms->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'ReservationRooms', 'action' => 'edit', $reservationRooms->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReservationRooms', 'action' => 'delete', $reservationRooms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservationRooms->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
