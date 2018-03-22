<section class="content-header">
    <h1>
        Display Table
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php //echo $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>

<style>
    .info-box-icon{background: #fff;}
    table tr td{padding: 5px; border: 1px solid #ccc;}
    .popup-menu
    {
        font-size: 12px;
        display: block;
        border: 1px solid red;
        width: 135px;
        top: -11px;
        text-align: left;
    }
    .info-box-icon ul li{
        height: 25px;
        line-height: 25px;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                <?php //echo $this->Form->create($restaurantTable, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    $total_col = 2;
                    $total_record_col = ceil(count($restaurant_tbl_ar) / $total_col);
                    $booking_color_array = array(0=>'info-box-icon bg-aqua',1=>'info-box-icon',2=>'info-box-icon bg-red');

                    if (count($restaurant_tbl_ar) > 0) {
                        $t = 0;
                        ?><table border="0" ><?php
                            for ($i = 0; $i < $total_record_col; $i++) {
                                ?>
                                <tr>
                                    <td class="<?php echo $booking_color_array[$restaurant_tbl_ar[$t]->booking_status];?>" id="table_<?php echo $restaurant_tbl_ar[$t]->code;?>">
                                        <?php
                                        $page_url = '';
                                        if($restaurant_tbl_ar[$t]->booking_status==1)
                                            $page_url = DEFAULT_URL.'kots/add/'.$restaurant_tbl_ar[$t]->code;
                                        if($restaurant_tbl_ar[$t]->booking_status==0)
                                        {
                                            if($restaurant_tbl_ar[$t]->Kots['kot_status']=='')
                                                $page_url = DEFAULT_URL.'kots/add/'.$restaurant_tbl_ar[$t]->code;
                                            else
                                                $page_url = DEFAULT_URL.'kots/add-more/'.$restaurant_tbl_ar[$t]->Kots['id'];
                                        }

                                        if($page_url!='')
                                        {?>
                                            <a href="<?php echo $page_url?>">
                                                <?php echo $restaurant_tbl_ar[$t]->code;?>
                                            </a>
                                        <?php
                                        }
                                        else
                                            echo $restaurant_tbl_ar[$t]->code;

                                        $t++;
                                        ?>
                                    </td>
                                    <?php

                                    if(isset($restaurant_tbl_ar[$t]->code) && $restaurant_tbl_ar[$t]->code!='')
                                    { ?>
                                    <td class="<?php echo $booking_color_array[$restaurant_tbl_ar[$t]->booking_status];?>" id="table_<?php echo $restaurant_tbl_ar[$t]->code;?>">
                                        <?php
                                        if(isset($restaurant_tbl_ar[$t]->code) && $restaurant_tbl_ar[$t]->code!='')
                                        {
                                            $page_url = '';
                                            if($restaurant_tbl_ar[$t]->booking_status==1)
                                                $page_url = DEFAULT_URL.'kots/add/'.$restaurant_tbl_ar[$t]->code;
                                            if($restaurant_tbl_ar[$t]->booking_status==0)
                                            {
//                                                if(isset($restaurant_tbl_ar[$t]->Kots['kot_status']) && ($restaurant_tbl_ar[$t]->Kots['kot_status']=='' || $restaurant_tbl_ar[$t]->Kots['kot_status']==0))
                                                if($restaurant_tbl_ar[$t]->Kots['kot_status']=='')
                                                    $page_url = DEFAULT_URL.'kots/add/'.$restaurant_tbl_ar[$t]->code;
                                                else
                                                    $page_url = DEFAULT_URL.'kots/add-more/'.$restaurant_tbl_ar[$t]->Kots['id'];
                                            }

                                            if($page_url!='')
                                            {?>
                                                <a href="<?php echo $page_url;?>">
                                                    <?php echo $restaurant_tbl_ar[$t]->code;?>
                                                </a>
                                            <?php
                                            }
                                            else
                                                echo $restaurant_tbl_ar[$t]->code;

                                            $t++;
                                        }?>
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    /* *
                                        ?>
                                    <td class="info-box-icon" id="table_6">
                                        <a href="#" class="rest-table-menu">6</a>
                                        <ul class="popup-menu" style="">
                                            <li>
                                                <a href="#">
                                                    Change Status
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">KOT Entry</a>
                                            </li>
                                            <li><a href="#">Sale Bill</a></li>
                                            <li><a href="#">Cancel</a></li>
                                        </ul>
                                    </td>
                                    <?php
                                    /* */
                                    }?>
                                </tr>
                                <?php
                            }
                            ?></table><?php
                    }

//                    pr($restaurant_tbl_ar);
//                    exit;
                    ?>
                    <br>
                    <!-- overlayed element -->

                    <table border="1" >
                    <tr style="">
                            <td>Not-Occupied</td>
                            <td class="bg-aqua">Occupied</td>
                            <td class="bg-red">Booked</td>
                        </tr>
                    </table>
                </div>
                <div id="dialogModal">
                    <!-- the external content is loaded inside this tag -->
                    <div class="contentWrap">Test</div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <?php //echo $this->Form->button(__('Save')) ?>
                </div>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>