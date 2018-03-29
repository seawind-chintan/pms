<section class="content-header">
    <h1>
        Waterpark Kot
        <small><?= __('Add') ?></small>
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
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Form') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($waterparkKot, array('role' => 'form')) ?>
                <div class="box-body">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group input">
                                    <label >Kot No:</label>
                                    <?php echo $lastkot_data->waterpark_kot_no; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input">
                                    <label>Kot Date:</label>
                                    <?php echo date('d-m-Y H:i:s', strtotime($lastkot_data->created)); ?>
                                </div>
                            </div>
                        </div>
                        <?php /* */ ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?php echo $this->Form->input('restaurant_kitchen_id', ['options' => $kitchen_list, 'empty' => 'Select Kitchen', 'onChange' => 'ajax_menu_list(this.value)']);?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item']);?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.qty', ['label' => 'Quantity/Plate', 'onBlur' => 'cal_item_price()']);?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.rate', ['readonly' => true]);?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('amount', ['readonly' => true]);?>
                            </div>
                        </div>
                        <?php /* */ ?>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Save')) ?>
                </div>
                <?= $this->Form->end() ?>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= ('No') ?></th>
                                            <th><?= ('Kitchen') ?></th>
                                            <th><?= ('Menu Name') ?></th>
                                            <th><?= ('Quantity') ?></th>
                                            <th><?= ('Price') ?></th>
                                            <th><?= ('Total Price') ?></th>
                                            <th><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /* */
                                        $i = 1;
                                        $final_total = 0;
                                        foreach ($kotitems_data as $kotitem_data):
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $kitchen_list[$kotitem_data['restaurant_kitchen_id']] ?></td>
                                                <td><?= $kotitem_data['menu_name'] ?></td>
                                                <td><?= $kotitem_data['qty'] ?></td>
                                                <td><?= $this->Number->currency($kotitem_data['price'], 'INR') ?></td>
                                                <td>
                                                    <?php
                                                    $sub_total = ($kotitem_data['qty'] * $kotitem_data['price']);
                                                    $final_total = $final_total + $sub_total;
                                                    echo $this->Number->currency($sub_total, 'INR');
                                                    ?>
                                                </td>
                                                <td class="actions" style="white-space:nowrap">
                                                    <?php /* */ ?>
                                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kotitem_data['id']], ['class' => 'btn btn-warning btn-xs']); ?>
                                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kotitem_data['id']], ['confirm' => __('Confirm to delete this entry?'), 'class' => 'btn btn-danger btn-xs']); ?>

                                                    <?php /*                                                     * ?>
                                                      <?php
                                                      //echo $this->Html->link(__('View'), ['action' => 'view', $kotitem_data['id']], ['class'=>'btn btn-info btn-xs']);
                                                      echo $this->Html->link(__('Edit'), ['action' => 'edit', $kotitem_data['id']], ['class'=>'btn btn-warning btn-xs']) ;
                                                      echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $kotitem_data['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ;
                                                      ?>
                                                      <?php /* */ ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        endforeach;
                                        /* */
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-right" style="font-weight: bold;">Total Amount</td>
                                            <td style="font-weight: bold;">
                                                <?php echo $this->Number->currency($final_total, 'INR'); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group input">
                                            <a href="<?php echo DEFAULT_URL.'waterpark-kots/close_kot/'.$this->request->params['pass'][0];?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
    /* *
    function openpoupwin(kotid)
    {
        var pass_url = "<?php //echo DEFAULT_URL.'waterpark-kots/generate_kot/';?>"+kotid;
        window.open(pass_url, "width=600,height=500,top=0,left=0,toolbar=no,scrollbars=no,status=no,resizable=no");
    }
    /* */
    function cal_item_price()
    {
        var tprice = $('#waterpark-kot-items-qty').val() * $('#waterpark-kot-items-rate').val();
        $('#amount').val(tprice);
    }

    function ajax_menu_list(id)
    {
        $('#waterpark-kot-items-restaurant-menu-id').parent().attr('id', "rest_menu_id")
        $.ajax({
            url: "<?php echo DEFAULT_URL ?>waterpark-kots/ajax_menu_list/" + id,
            type: "POST",
            success: function (data)
            {
                $('#rest_menu_id').html(data);
            }
        });
    }
</script>
<?php $this->end(); ?>