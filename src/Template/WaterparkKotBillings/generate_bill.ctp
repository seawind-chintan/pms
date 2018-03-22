<section class="content-header">
    <!--    <h1>
    <?php //echo __('Customer Kot'); ?>
        </h1>-->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal" id="DivIdToPrint">
                        <style>
                            .dl-horizontal table tr td
                            {
                                padding: 5px;
                                vertical-align: top;
                            }
                            .itemdata tr td
                            {
                                padding: 5px;
                                vertical-align: top;
                                border: 1px solid #ccc;
                            }
                        </style>
                        <?php
                        if (isset($kitchen_ar) && count($kitchen_ar) > 0) {

                            //for($i=0;$i<count($kitchen_ar);$i++)
                            foreach ($diff_kitchen_array as $kitchen_id => $different_kitchen_item_array) {
                                ?>
                                <div class="">
                                    <h3>
                                        <?php echo __('Customer Kot'); ?>
                                    </h3>
                                </div>
                                <table border="0" cellspacing="5" cellpadding="5" width="100%"  >
                                    <tr>
                                        <td width="25%"><strong><?= __('Restaurant Name') ?></strong></td>
                                        <td>
                                            <?php
                                            $session = $this->request->session();
                                            echo $session->read('default_restaurant_name');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%"><strong><?= __('Kitchen Name') ?></strong></td>
                                        <td>
                                            <?php
                                            echo $kitchen_list_ar[$kitchen_id];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= __('Kot No') ?></strong></td>
                                        <td>
                                            <?php echo ($kot->waterpark_kot_no) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><?= __('Kot Date') ?></strong></td>
                                        <td>
                                            <?php echo $this->Time->format($kot->modified, 'dd-MM-yyyy HH:mm:ss') ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <table class="itemdata" border="0" cellspacing="5" cellpadding="5" width="70%">
                                                <tr>
                                                    <td width="10%"><strong><?= __('Sr No') ?></strong></td>
                                                    <td width="25%"><strong><?= __('Item Name') ?></strong></td>
                                                    <td width="20%"><strong><?= __('Quantity') ?></strong></td>
                                                </tr>
                                                <?php
                                                for ($i = 0; $i < count($different_kitchen_item_array); $i++) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ($i + 1); ?></td>
                                                        <td><?php echo $different_kitchen_item_array[$i]->menu_name; ?></td>
                                                        <td><?php echo $different_kitchen_item_array[$i]->qty; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <?php
                            }
                        }
                        ?>
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