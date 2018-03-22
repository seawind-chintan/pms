<section class="content-header">
    <h1>
        <?php echo __('Customer Kot'); ?>
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
                            border:1px solid #ccc;
                        }

                    </style>
                        <table border="0" cellspacing="5" cellpadding="5" width="100%"  >
                            <tr>
                                <td width="20%"><strong><?= __('Restaurant Name') ?></strong></td>
                                <td>
                                    <?php
                                    $session = $this->request->session();
                                    echo ($session->read('default_restaurant_name'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Order Date') ?></strong></td>
                                <td>
                                    <?php echo $this->Time->format($kot->modified,'dd-MM-yyyy HH:mm:ss')?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Kot No') ?></strong></td>
                                <td>
                                    <?php echo ($kot->kot_no)?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Table NO') ?></strong></td>
                                <td>
                                    <?php echo ($kot->restaurant_table_code)?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?= __('Pax') ?></strong></td>
                                <td>
                                    <?php echo ($kot->no_of_pax)?>
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
                                        if(count($kot->kot_items)>0)
                                        {
                                            for($i=0;$i<count($kot->kot_items);$i++)
                                            {?>
                                            <tr>
                                                <td><?php echo ($i+1);?></td>
                                                <td><?php echo $kot->kot_items[$i]->menu_name; ?></td>
                                                <td><?php echo $kot->kot_items[$i]->qty; ?></td>
                                            </tr>
                                            <?php
                                            }
                                        }
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->
</section>
