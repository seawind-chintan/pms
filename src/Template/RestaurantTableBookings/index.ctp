<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Restaurant Table Bookings
        <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Table Bookings</h3>
                    <div class="box-tools">
                        <?php
                        $search_text = '';
                        if (isset($this->request->query['search']) && trim($this->request->query['search']) != '') {
                            $search_text = trim($this->request->query['search']);
                        }
                        ?>
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>" value="<?php echo trim($search_text); ?>">
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
                                <?php /*                                 * ?><th><?= $this->Paginator->sort('property_id') ?></th><?php /* */ ?>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('book_by') ?></th>
                                <th><?= $this->Paginator->sort('mobile') ?></th>
                                <th><?= ('Total Pax') ?></th>
                                <?php /* */ ?><th><?= ('Booking Date') ?></th><?php /* */ ?>
                                <?php /* */ ?><th><?= ('Booking Time') ?></th><?php /* */ ?>
                                <th><?= ('Booked Table') ?></th>
                                <th><?= ('Status') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            pr($restaurantTableBookings);
//                            echo count($restaurantTableBookings);
//                            if(isset($restaurantTableBookings))
//                                echo "if";
//                            else
//                                echo "else";
//                            exit;

                            if(count($restaurantTableBookings)>0)
                            {
                            foreach ($restaurantTableBookings as $restaurantTableBooking):

//                pr($restaurantTableBooking);
//                exit;
                                ?>
                                <tr>
                                    <td><?= $this->Number->format($restaurantTableBooking->id) ?></td>
                                    <?php /*                                     * ?><td><?= $this->Number->format($restaurantTableBooking->property_id) ?></td><?php /* */ ?>
                                    <td><?= h($restaurantTableBooking->name) ?></td>
                                    <td><?= h($restaurantTableBooking->book_by) ?></td>
                                    <td><?= h($restaurantTableBooking->mobile) ?></td>
                                    <td><?= h($restaurantTableBooking->no_of_pax) ?></td>
                                    <td>
                                        <?php
                                        echo $this->Time->format($restaurantTableBooking->booking_date, 'd-M-Y');
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $restaurantTableBooking->booking_time->i18nFormat([\IntlDateFormatter::NONE, \IntlDateFormatter::SHORT]);
//                echo  $this->Time->i18nFormat($restaurantTableBooking->booking_time,[\IntlDateFormatter::NONE, \IntlDateFormatter::SHORT]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $select_table_array = array();
                                        $set_table_ar = explode(',', $restaurantTableBooking->restaurant_table_ids);

                                        if (!empty($set_table_ar)) {
                                            for ($i = 0; $i < count($set_table_ar); $i++) {
                                                $select_table_array[] = $table_array[$set_table_ar[$i]];
                                            }
                                            echo $select_table = implode(', ', $select_table_array);
                                        }
                                        ?>
                                    </td>
                                    <td><?= $restaurant_booking_status_array[$restaurantTableBooking->booking_status] ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $restaurantTableBooking->id], ['class' => 'btn btn-info btn-xs']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurantTableBooking->id], ['class' => 'btn btn-warning btn-xs']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurantTableBooking->id], ['confirm' => __('Confirm to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                    </td>
                                </tr>
                            <?php endforeach;
                            }
//                            else
//                            {
//                                echo '<tr>
//                                        <td colspan="10" class="error">No Record Found.</td>
//                                    </tr>';
//                            }
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
