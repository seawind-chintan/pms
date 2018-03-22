<section class="content-header">
    <h1>
        Kot
        <small><?= __('Edit') ?></small>
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
                                <?php echo $kot->kot_no;?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label>Order Date:</label>
                                <?php echo ($kot->created);?>
                            </div>
                        </div>
                    </div>
                    <?php /* */ ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?php
                            //echo $this->Form->input('property_id', ['options' => $properties,'readonly'=>true,'label' => 'Restaurant']);
                            echo $this->Form->input('restaurant_kitchen_id', ['options' => $kitchen_list, 'empty' => 'Select Kitchen','onChange'=>'ajax_menu_list(this.value)','value'=>$kot_items->restaurant_kitchen_id]);
                            echo $this->Form->input('kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item','value'=>$kot_items->restaurant_menu_id,'onChange'=>'getmenu_price(this.value)']);
                            echo $this->Form->input('kot_items.qty',['label'=>'Quantity/Plate','onBlur'=>'cal_item_price()','value'=>$kot_items->qty]);
                            echo $this->Form->input('amount',['readonly'=>true,'value'=>($kot_items->qty * $menu_list_data['price'])]);
                            echo $this->Form->input('remark',['label'=>'Remark']);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('restaurant_table_id', ['options' => $table_array, 'empty' => 'Select Table','value'=>$kot_items->restaurant_table_id,'readonly'=>true]);
                            echo $this->Form->input('restaurant_waiter_id', ['options' => $waiter_list, 'empty' => 'Select Waiter','value'=>$kot_items->restaurant_waiter_id]);
                            echo $this->Form->input('no_of_pax');
                            echo $this->Form->input('kot_items.rate',['readonly'=>true,'value'=>$menu_list_data['price']]);
                            echo $this->Form->input('nc_kot', array(
//                                        'label' => ,
                                        'type' => 'checkbox',
                                        'value' => 'Yes',
                                    ));
                            /* *
                            echo $this->Form->input('split', array(
                                        'type' => 'checkbox',
                                        'value' => 'Yes',
                                    ));
                            /* */
                            ?>
                        </div>
                    </div>
                    <?php
                    /* *
                    echo $this->Form->input('property_id', ['options' => $properties]);
                    echo $this->Form->input('kot_no');
                    echo $this->Form->input('restaurant_table_id', ['options' => $restaurantTables, 'empty' => true]);
                    echo $this->Form->input('restaurant_table_code');
                    echo $this->Form->input('no_of_pax');
                    echo $this->Form->input('steward');
                    echo $this->Form->input('nc_kot');
                    echo $this->Form->input('remark');
                    echo $this->Form->input('split');
                    echo $this->Form->input('amount');
                    echo $this->Form->input('total_qty');
                    echo $this->Form->input('bill_paid');
                    /* */
                    ?>
                </div>

                <div class="box-body">

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Save')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

    //For edit time
    //ajax_menu_list("<?php //echo $kot_items->restaurant_kitchen_id;?>");

    function cal_item_price()
    {
        var tprice = $('#kot-items-qty').val() * $('#kot-items-rate').val();
        $('#amount').val(tprice);
        //alert(tprice);
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
<script type="text/javascript">
function getmenu_price(id)
{

    $('#kot-items-rate').parent().attr('id', "price_div")
    if(id!='')
    {
        $.ajax({
            url: "<?php echo DEFAULT_URL?>kots/ajax_menu_price/"+id,
            type: "POST",
            success: function(data)
            {
//              alert(data);
                $('#price_div').html(data);

                if($('#kot-items-qty').val()!='')
                {
                     cal_item_price();
                }


            }
        });
    }
}
</script>
