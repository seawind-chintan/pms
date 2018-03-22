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
                                    <?php echo $nextkot_id; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input">
                                    <label>Kot Date:</label>
                                    <?php echo date('d-m-Y H:i:s'); ?>
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
</script>
<?php $this->end(); ?>