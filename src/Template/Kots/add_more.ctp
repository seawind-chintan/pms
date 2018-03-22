<section class="content-header">
    <h1>
        Kot
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
                <?= $this->Form->create($kot, array('role' => 'form')) ?>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label >Kot No:</label>
                                <?php echo $lastkot_data->kot_no; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label>Order Date:</label>
                                <?php //echo $this->Time->i18nFormat($lastkot_data->created,[\IntlDateFormatter::NONE, \IntlDateFormatter::SHORT]);?>
                                <?php echo date('d-m-Y H:i:s', strtotime($lastkot_data->created)); ?>
                            </div>
                        </div>
                    </div>
                    <?php /* */ ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?php
                            //echo $this->Form->input('property_id', ['options' => $properties,'readonly'=>true,'label' => 'Restaurant']);
                            echo $this->Form->input('restaurant_kitchen_id', ['options' => $kitchen_list, 'empty' => 'Select Kitchen', 'onChange' => 'ajax_menu_list(this.value)']);
                            echo $this->Form->input('kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item']);
                            echo $this->Form->input('kot_items.qty', ['label' => 'Quantity/Plate', 'onBlur' => 'cal_item_price()']);
                            echo $this->Form->input('amount', ['readonly' => true,'value'=>'']);
                            echo $this->Form->input('remark', ['label' => 'Remark','value'=>$lastkot_data->remark]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('restaurant_table_id', ['options' => $table_array, 'value' => $lastkot_data->restaurant_table_id,'readonly'=>true]);
                            echo $this->Form->input('restaurant_waiter_id', ['options' => $waiter_list, 'empty' => 'Select Waiter', 'value' => $lastkot_data->restaurant_waiter_id]);
                            echo $this->Form->input('no_of_pax', ['value' => $lastkot_data->no_of_pax]);
                            echo $this->Form->input('kot_items.rate', ['readonly' => true]);
                            $ncchecked = ($lastkot_data->nc_kot=='Yes')?'checked':'';
                            echo $this->Form->input('nc_kot', array(
                                'type' => 'checkbox',
                                'value' => 'Yes',
                                $ncchecked
                            ));

                            /* *
                            $splitchecked = ($lastkot_data->split=='Yes')?'checked':'';
                            echo $this->Form->input('split', array(
//                                        'label' => ,
                                'type' => 'checkbox',
                                'value' => 'Yes',
                                $splitchecked
                            ));
                            /* */
                            ?>
                        </div>
                    </div>
                    <?php /* */ ?>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Add')) ?>
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
                                    $i=1;
                                    $final_total = 0;
                                    foreach ($kotitems_data as $kotitem_data):
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $kitchen_list[$kotitem_data['restaurant_kitchen_id']] ?></td>
                                            <td><?= $kotitem_data['menu_name'] ?></td>
                                            <td><?= $kotitem_data['qty'] ?></td>
                                            <td><?= $kotitem_data['menu_price'] ?></td>
                                            <td>
                                                <?php
                                                echo $sub_total = ($kotitem_data['qty']*$kotitem_data['menu_price']);
                                                $final_total = $final_total + $sub_total;
                                                ?>
                                            </td>
                                            <td class="actions" style="white-space:nowrap">
                                                <?php /* */ ?>
                                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kotitem_data['id']], ['class'=>'btn btn-warning btn-xs']);?>
                                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kotitem_data['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ;?>

                                                <?php /* * ?>
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
                                            <?php echo $final_total;?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <?= $this->Form->create('generate_kot',array('name'=>'generate_kot',  'role' => 'form')) ?>
                                <div class="col-md-6">
                                    <div class="form-group input">
                                        <input type="hidden" name="kot_id" id="kot_id" value="<?php echo $this->request->params['pass'][0]?>">
                                        <?php //echo $this->Form->button(__('Generate KOT')) ?>
                                        <?php echo $this->Form->button(__('Generate KOT'),array('name'=>'btngenerate_kot','value'=>'Generate KOT')) ?>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    function cal_item_price()
    {
        var tprice = $('#kot-items-qty').val() * $('#kot-items-rate').val();
        $('#amount').val(tprice);
//    alert(tprice);
    }

    function ajax_menu_list(id)
    {

        //alert(id);
//alert("hello");
//var state = jQuery('#userdetail-state').val();
//alert(state);
//dataString="state_id="+id;
        $('#kot-items-restaurant-menu-id').parent().attr('id', "rest_menu_id")
        $.ajax({
            url: "<?php echo DEFAULT_URL ?>kots/menu_list/" + id,
            type: "POST",
            /*data: dataString,*/
            success: function (data)
            {
//              alert(data);
                $('#rest_menu_id').html(data);
            }
        });
    }
</script>