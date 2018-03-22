<section class="content-header">
    <h1>
        Waterpark Kot
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
                <?= $this->Form->create($waterparkKot, array('role' => 'form')) ?>
                <div class="box-body">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group input">
                                    <label >Kot No:</label>
                                    <?php echo $waterpark_kot_items->waterpark_kot_no; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input">
                                    <label>Kot Date:</label>
                                    <?php echo date('d-m-Y H:i:s', strtotime($waterpark_kot_items->created)); ?>
                                </div>
                            </div>
                        </div>
                        <?php /* */ ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?php echo $this->Form->input('restaurant_kitchen_id', ['options' => $kitchen_list, 'empty' => 'Select Kitchen', 'onChange' => 'ajax_menu_list(this.value)','value'=>$waterpark_kot_items->restaurant_kitchen_id]); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.restaurant_menu_id', ['options' => $menulist, 'empty' => 'Select Item','value'=>$waterpark_kot_items->restaurant_menu_id,'onChange'=>'getmenu_price(this.value)']); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.qty', ['label' => 'Quantity/Plate', 'onBlur' => 'cal_item_price()','value'=>$waterpark_kot_items->qty]); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('waterpark_kot_items.rate', ['readonly' => true,'value'=>$waterpark_kot_items['price']]); ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $this->Form->input('amount', ['readonly' => true,'value'=>($waterpark_kot_items->qty * $waterpark_kot_items['price'])]); ?>
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
            </div>
        </div>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
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
    function getmenu_price(id)
    {

        $('#waterpark-kot-items-rate').parent().attr('id', "price_div")
        if(id!='')
        {
            $.ajax({
                url: "<?php echo DEFAULT_URL?>waterpark-kots/ajax_menu_price/"+id,
                type: "POST",
                success: function(data)
                {
    //              alert(data);
                    $('#price_div').html(data);

                    if($('#waterpark-kot-items-qty').val()!='')
                    {
                         cal_item_price();
                    }
                }
            });
        }
    }
</script>
<?php $this->end(); ?>
