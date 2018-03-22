<section class="content-header">
        <h1>
    <?php echo __('Customer Bill'); ?>
        </h1>
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
                        <?= $this->Form->create($waterparkBeltTransaction, array('role' => 'form')) ?>
                        <table border="0" cellspacing="5" cellpadding="5" width="100%"  >
                            <tr>
                                <td width="25%"><strong><?= __('Restaurant Name') ?></strong></td>
                                <td>
                                    <?php
                                    echo $properties->name;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><strong><?= __('Bill No.') ?></strong></td>
                                <td>
                                    <?php
                                    echo $waterparkKotBilling->id;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Bill Date') ?></strong></td>
                                <td>
                                    <?php echo $this->Time->format($waterparkKotBilling->created, 'dd-MM-yyyy HH:mm:ss') ?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <table class="itemdata" border="0" cellspacing="5" cellpadding="5" width="70%">
                                        <tr>
                                            <td width="10%" class="text-center"><strong><?= __('Sr No') ?></strong></td>
                                            <td width="25%"><strong><?= __('Item Name') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Quantity') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Rate') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Amount') ?></strong></td>
                                        </tr>
                                        <?php $different_kitchen_item_array = $waterparkKotBilling->waterpark_kot_item_billings;
                                        for ($i = 0; $i < count($different_kitchen_item_array); $i++) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo ($i + 1); ?></td>
                                                <td><?php echo $different_kitchen_item_array[$i]->menu_name; ?></td>
                                                <td class="text-center"><?php echo $different_kitchen_item_array[$i]->qty; ?></td>
                                                <td class="text-right"><?php echo $this->Number->precision($different_kitchen_item_array[$i]->price,2); ?></td>
                                                <td class="text-right"><?php echo $this->Number->precision($different_kitchen_item_array[$i]->total_price,2); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    <br>
                                    <table class="itemdata" border="0" cellspacing="5" cellpadding="5" width="70%">
                                        <tr>
                                            <td width="80%"><strong><?= __('Total Amount') ?></strong></td>
                                            <td class="text-right" width="20%"><?php echo $this->Number->precision($waterparkKotBilling->total_amount,2);?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?= __('Total CGST') ?></strong></td>
                                            <td class="text-right"><?php echo $this->Number->precision($waterparkKotBilling->total_cgst,2);?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?= __('Total SGST') ?></strong></td>
                                            <td class="text-right"><?php echo $this->Number->precision($waterparkKotBilling->total_sgst,2);?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?= __('Net Amount') ?></strong></td>
                                            <td class="text-right">
                                                <strong><?php echo $this->Number->precision(($waterparkKotBilling->total_amount + $waterparkKotBilling->total_cgst + $waterparkKotBilling->total_sgst),2);?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    
                                        <?php
                                        if($waterparkKotBilling->bill_status==0)
                                        {
                                        ?>
                                        <div class="col-sm-12">
                                            <div class="col-sm-2">
                                                <strong><?= __('Pay With') ?></strong>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('bill_id', [ 'type' => 'hidden', 'value' => $waterparkKotBilling->id, 'readonly' => true]);
                                                echo $this->Form->input('belt_id', ['label' => false, 'options' => $issue_belt_array, 'style' => ['width:180px']]);
                                                ?>
                                            </div>                                        
                                            <div class="col-sm-7">
                                                <?= $this->Form->button(__('Pay Bill')) ?>
                                            </div>
                                        </div>
                                        <?php 
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="col-sm-2">
                                        <a target="_blank" href="<?php echo DEFAULT_URL.'waterpark-kot-billings/bill_print/'.$waterparkKotBilling->id;?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                     <?php   

                                    }?>
                                    
                                </td>
                            </tr>
                        </table>
                        <?= $this->Form->end() ?>
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