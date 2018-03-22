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
                                <?php echo $nextkot_id;?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label>Order Date:</label>
                                <?php echo date('d-m-Y H:i:s');?>
                            </div>
                        </div>
                    </div>
                    <?php /* */ ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?php
                            //echo $this->Form->input('property_id', ['options' => $properties,'readonly'=>true,'label' => 'Restaurant']);
                            echo $this->Form->input('restaurant_kitchen_id', ['options' => $kitchen_list, 'empty' => 'Select Kitchen','onChange'=>'ajax_menu_list(this.value)']);
                            echo $this->Form->input('kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item']);
                            echo $this->Form->input('kot_items.qty',['label'=>'Quantity/Plate','onBlur'=>'cal_item_price()']);
                            echo $this->Form->input('amount',['readonly'=>true]);
                            echo $this->Form->input('remark',['label'=>'Remark']);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            $select_table_no = (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]!='')?$this->request->params['pass'][0]:'';
                            if(in_array($select_table_no,$em_table_arr))
                                echo $this->Form->input('restaurant_table_id', ['options' => $table_array, 'empty' => 'Select Table','value'=>array($select_table_no)]);
                            else
                                echo $this->Form->input('restaurant_table_id', ['options' => array($select_table_no=>$select_table_no),'readonly'=>true,'value'=>array($select_table_no)]);

                            echo $this->Form->input('restaurant_waiter_id', ['options' => $waiter_list, 'empty' => 'Select Waiter']);
                            echo $this->Form->input('no_of_pax');
                            echo $this->Form->input('kot_items.rate',['readonly'=>true]);
                            echo $this->Form->input('nc_kot', array(
//                                        'label' => ,
                                        'type' => 'checkbox',
                                        'value' => 'Yes',
                                    ));
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
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
function cal_item_price()
{
    var tprice = $('#kot-items-qty').val()*$('#kot-items-rate').val();
    $('#amount').val(tprice);
}

function ajax_menu_list(id)
{

    $('#kot-items-restaurant-menu-id').parent().attr('id', "rest_menu_id")
    $.ajax({
            url: "<?php echo DEFAULT_URL?>kots/menu_list/"+id,
            type: "POST",
            success: function(data)
             {
                $('#rest_menu_id').html(data);
             }
        });
}
</script>