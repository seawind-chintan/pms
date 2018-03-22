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
                <div class="box-body">
                    <dl class="dl-horizontal" id="DivIdToPrint">
                        <style>
                        .dl-horizontal table tr td
                        {
                            padding: 5px;
                            vertical-align: top;
                            /* border: 0px solid #ccc;*/
                        }
                        .itemdata tr td
                        {
                            padding: 5px;
                            vertical-align: top;
                            border-bottom: 1px solid #ccc;
                        }
                        </style>
                        <table border="0" cellspacing="5" cellpadding="5" width="100%">
                            <tr>
                                <td colspan="4" class="text-center" style="font-size: 18px;"><strong><?= __('Customer Bill') ?></strong></td>
                            </tr>
                            <tr>
                                <td width="20%"><strong><?= __('Restaurant Name') ?></strong></td>
                                <td colspan="3">
                                    <?php
                                    $session = $this->request->session();
                                    echo ($session->read('default_restaurant_name'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%"><strong><?= __('Bill No') ?></strong></td>
                                <td width="30%">
                                    <?php echo 1 ;?>
                                </td>
                                <td width="15%"><strong><?= __('Bill Date') ?></strong></td>
                                <td width="35%">
                                    <?php echo $this->Time->format($kot[0]->modified,'dd-MM-yyyy HH:mm:ss')?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Table NO') ?></strong></td>
                                <td colspan="3">
                                    <?php echo ($kot[0]->restaurant_table_code)?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="itemdata" border="0" cellspacing="5" cellpadding="5" width="70%">
                                        <tr>
                                            <td width="10%" class="text-center"><strong><?= __('Sr No') ?></strong></td>
                                            <td width="25%"><strong><?= __('Item Name') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Quantity') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Price') ?></strong></td>
                                            <td width="20%" class="text-center"><strong><?= __('Amount') ?></strong></td>
                                        </tr>
                                        <?php
                                        $sub_total = $total_price = $sno = 0;
                                        if(count($kot)>0)
                                        {
                                            for($j=0;$j<count($kot);$j++)
                                            {
                                                if(count($kot[$j]->kot_items)>0)
                                                {
                                                    for($i=0;$i<count($kot[$j]->kot_items);$i++)
                                                    {
                                                        $sno++;
                                                        $bill_data = $kot[$j]->kot_items[$i];
                                                        ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo ($sno);?></td>
                                                        <td><?php echo $bill_data->menu_name; ?></td>
                                                        <td class="text-center"><?php echo $qty = $bill_data->qty; ?></td>
                                                        <td class="text-right"><?php echo $price = $bill_data->menu_price; ?></td>
                                                        <td class="text-right"><?php echo $sub_total = ($price * $qty); ?></td>
                                                    </tr>
                                                    <?php
                                                    $total_price = $total_price + $sub_total;
                                                    }
                                                }
                                            }
                                        }
                                        /* */
                                        if($total_price>0)
                                        {

                                            ?>
                                            <tr><td colspan="5">&nbsp;</td></tr>
                                            <tr>
                                                <td colspan="4"><strong>Total Price</strong></td>
                                                <td class="text-right"><strong><?php echo $total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>Discount </strong></td>
                                                <td class="text-right"><strong><?php echo 0 //$total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>Net Amount</strong></td>
                                                <td class="text-right"><strong><?php echo $total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>CGST</strong></td>
                                                <td class="text-right"><strong><?php echo 0 //$total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>SGST</strong></td>
                                                <td class="text-right"><strong><?php echo 0 //$total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>Grand Total</strong></td>
                                                <td class="text-right"><strong><?php echo $total_price; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>Net To Pay</strong></td>
                                                <td class="text-right"><strong><?php echo $total_price; ?></strong></td>
                                            </tr>
                                            <?php
                                        }
                                        /* */
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </dl>
                    <input type='button' id='btn' value='Print' onclick='printDiv();'>
                    <script type="text/javascript">
                        function printDiv()
                        {
                            var divToPrint=document.getElementById('DivIdToPrint');
                            var newWin=window.open('','Print-Window', "width=600,height=500,top=0,left=0,toolbar=no,scrollbars=no,status=no,resizable=no");
                            newWin.document.open();
                            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                            newWin.document.close();
                            setTimeout(function(){newWin.close();},10);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
