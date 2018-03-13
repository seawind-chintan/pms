<?php $this->layout = 'AdminLTE.print'; ?>

<?php // pr($checkinBilling); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#<?=$checkinBilling->bill_number?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->Url->build(array('controller' => 'checkins', 'action' => 'index')); ?>">Checkins</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?=$checkinBilling->checkin->property->name?>.
            <small class="pull-right">Date: <?=date('Y-m-d')?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?=$checkinBilling->checkin->property->name?>.</strong><br>
            <?=$checkinBilling->checkin->property->address?><br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?=$checkinBilling->checkin->member->first_name?> <?=$checkinBilling->checkin->member->last_name?></strong><br>
            <?=$checkinBilling->checkin->member->cor_address?><br>
            <?=$checkinBilling->checkin->member->cor_city->name?>, <?=$checkinBilling->checkin->member->cor_state->name?>, <?=$checkinBilling->checkin->member->cor_country->name?>. <?=$checkinBilling->checkin->member->cor_pincode?>.<br>
            Phone: <?=$checkinBilling->checkin->member->mobile?><br>
            Email: <?=$checkinBilling->checkin->member->email?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?=$checkinBilling->bill_number?></b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> <?=date('Y-m-d')?><br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Room</th>
              <th>Occupancy #</th>
              <th>Total Nights</th>
              <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $arrv_date = new DateTime($checkinBilling->checkin->arrival_date_time);
            $dept_date = new DateTime($checkinBilling->checkin->dept_date_time);
            // this calculates the diff between two dates, which is the number of nights
            $numberOfNights= $dept_date->diff($arrv_date)->format("%a");

            $checkin_rooms_rates_arr = $checkinBilling->checkin->checkin_rooms_rates;
            foreach ($checkin_rooms_rates_arr as $checkin_rooms_rates_key => $checkin_rooms_rates_value) {
              ?>
                <tr>
                  <td>Room no #<?=$checkin_rooms_rates_value->room->number?></td>
                  <td>Adult(s):<?=$checkin_rooms_rates_value->no_of_adult?>,Child(s):<?=$checkin_rooms_rates_value->no_of_child?></td>
                  <td><?=$numberOfNights?></td>
                  <td><?=$checkin_rooms_rates_value->room_rate->rate?></td>
                </tr>
              <?php  
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <?php echo $this->Html->image('credit/visa.png', array('alt' => 'Visa')); ?>
            <?php echo $this->Html->image('credit/mastercard.png', array('alt' => 'Mastercard')); ?>
            <?php echo $this->Html->image('credit/american-express.png', array('alt' => 'American Express')); ?>
            <?php echo $this->Html->image('credit/paypal2.png', array('alt' => 'Paypal')); ?>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <?=date('Y-m-d')?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?=$checkinBilling->net_amount?></td>
              </tr>
              <tr>
                <th>Tax</th>
                <td><?=$checkinBilling->tax_amount?></td>
              </tr>
              <!-- <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr> -->
              <tr>
                <th>Total:</th>
                <td><?=$checkinBilling->total_amount?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
