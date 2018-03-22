<?php $this->layout = 'AdminLTE.ajax'; ?>

<?php
if(!empty($waterparkTicket->payment_mode)){
                $payment_mode = "Card";
            } else {
                $payment_mode = "Cash";
            }

            echo '<div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ticket Preview</h4>
                        </div>
                        <div class="modal-body">
                          <div>
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
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          '.$this->Html->link(__('Print'), ['action' => 'printticket', $waterparkTicket->id], ['target' => '_blank', 'class'=>'btn btn-primary']).'
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>';exit;