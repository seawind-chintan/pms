<section class="content-header">
    <h1>
        <?php echo __('Restaurant Table Booking'); ?>
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
                        <dt><?= __('Property Id') ?></dt>
                        <dd>
                            <?php
                            $session = $this->request->session();
//                            $select_restaurant_id = $session->read('default_restaurant_id');
                            echo ($session->read('default_restaurant_name'));
                            //echo $this->Number->format($restaurantTableBooking->property_id)
                            ?>
                        </dd>
                        <dt><?= __('Restaurant Table Ids') ?></dt>
                        <dd>
                            <?php echo $select_table_data;?>
                            <?php //echo ($restaurantTableBooking->restaurant_table_ids) ?>
                        </dd>

                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($restaurantTableBooking->name) ?>
                        </dd>
                        <dt><?= __('Book By') ?></dt>
                        <dd>
                            <?= h($restaurantTableBooking->book_by) ?>
                        </dd>
                        <dt><?= __('Email') ?></dt>
                        <dd>
                            <?= h($restaurantTableBooking->email) ?>
                        </dd>
                        <dt><?= __('Mobile') ?></dt>
                        <dd>
                            <?= h($restaurantTableBooking->mobile) ?>
                        </dd>
                        <dt><?= __('Booking Date') ?></dt>
                        <dd>
                            <?= $this->Time->format($restaurantTableBooking->booking_date,'d-M-Y'); ?>
                        </dd>
                        <dt><?= __('Booking Time') ?></dt>
                        <dd>
                            <?= $this->Time->i18nFormat($restaurantTableBooking->booking_time,[\IntlDateFormatter::NONE, \IntlDateFormatter::SHORT]); ?>
                        </dd>

                        <dt><?= __('Address') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($restaurantTableBooking->address)); ?>
                        </dd>
                        <dt><?= __('Remarks') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($restaurantTableBooking->remarks)); ?>
                        </dd>
                        <dt><?= __('No Of Pax') ?></dt>
                        <dd>
                            <?= $this->Number->format($restaurantTableBooking->no_of_pax) ?>
                        </dd>
                        <dt><?= __('Booking Status') ?></dt>
                        <dd>
                            <?= $restaurant_booking_status_array[($restaurantTableBooking->booking_status)] ?>
                        </dd>
                        <dt><?= __('Advanced Payment') ?></dt>
                        <dd>
                            <?= $this->Number->format($restaurantTableBooking->advanced_payment) ?>
                        </dd>
                        <dt><?= __('Status') ?></dt>
                        <dd>
                            <?= $status_options[($restaurantTableBooking->status)] ?>
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
