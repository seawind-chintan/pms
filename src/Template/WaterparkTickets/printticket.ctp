<?php $this->layout = 'AdminLTE.print'; ?>

<?php

if(!empty($waterparkTicket->payment_mode)){
    $payment_mode = "Card";
} else {
    $payment_mode = "Cash";
}
            
echo '<div>
  <p style="text-align:center;"><span><b>'.$waterparkTicket->property->name.'</b></span></p>
</div>
<div>
  <p><span>Ticket No <b>#'.$waterparkTicket->code.'</b></span><span class="pull-right">Mobile No <b>'.$waterparkTicket->mobileno.'</b></span></p>
</div>
<div>
  <p><span><b>-</b></span><span class="pull-right">No of Persons <b>'.$waterparkTicket->no_of_persons.'</b></span></p>
</div>
<hr>
<div>
  <p><span>Total Amount</span><span class="pull-right"><b>'.$this->Number->currency($waterparkTicket->total_amount, 'INR').' </b></span></p>
</div>
<div>
  <p><span>Balance when ticket generated</span><span class="pull-right"><b>'.$this->Number->currency($waterparkTicket->balance, 'INR').'</b></span></p>
</div>
<div>
  <p><span>Discount</span><span class="pull-right"><b>'.$this->Number->currency($waterparkTicket->discount_amount, 'INR').'</b></span></p>
</div>
<div>
  <p><span>Paid Amount</span><span class="pull-right"><b>'.$this->Number->currency($waterparkTicket->net_amount, 'INR').'</b></span></p>
</div>
<hr>
<div>
  <p><span>Payment mode</span><span class="pull-right"><b>'.$payment_mode.'</b></span></p>
</div>';
?>