<section class="content-header">
  <h1>
    Waterpark Ticket
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
        <?= $this->Form->create($waterparkTicket, array('role' => 'form')) ?>
          <div class="box-body">

          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Property details</h3>
              </div>
              <div class="box-body">
                  <?php
                  echo $this->Form->input('property_id', ['options' => $properties , 'templates' => ['inputContainer' => '<div class="row" id="single_date_selector"><div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('code', ['readonly' => true , 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('issued_by', ['value' => $user->user_detail->first_name.' '.$user->user_detail->last_name, 'readonly' => true, 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div></div>']]);
                  ?>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>


          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Ticket &amp; Member details</h3>
              </div>
              <div class="box-body">
                  <?php
                  echo $this->Form->input('is_member', ['type' => 'checkbox', 'label' => 'Is Member', 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-12">{{content}}</div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-12">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('mobileno', ['type' => 'number', 'templates' => ['inputContainer' => '<div class="row"><div class="input {{type}}{{required}} col-md-4">{{content}}</div></div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div></div>']]);
                  echo $this->Form->input('member_id_show', ['label' => 'Member','options' => $members, 'disabled' => 'disabled', 'empty' => 'Select Member', 'templates' => ['inputContainer' => '<div class="row" id="single_member_selector"><div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="row" id="single_member_selector"><div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('member_id', ['type' => 'hidden']);
                  echo $this->Form->input('member_type', ['readonly' => true, 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div></div>']]);

                  echo $this->Form->input('no_of_persons', ['min' => 0, 'max' => 50 , 'templates' => ['inputContainer' => '<div class="row" id="single_date_selector"><div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('no_of_adults', ['min' => 0, 'max' => 50 , 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('no_of_childs', ['min' => 0, 'max' => 50, 'templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div></div>']]);

                  echo $this->Form->input('total_amount', ['templates' => ['inputContainer' => '<div class="row" id="single_date_selector"><div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="row"><div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('hold_amount', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div>']]);
                  echo $this->Form->input('balance', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-4">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-4">{{content}}{{error}}</div></div>']]);
                  ?>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          

          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Discount &amp; Billing</h3>
              </div>
              <div class="box-body">
                  <?php
                  echo $this->Form->input('discount_code');
                  echo $this->Form->input('discount_amount');
                  ?>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Payment Information</h3>
              </div>
              <div class="box-body">
                  <?php
                  echo $this->Form->input('net_amount', ['readonly' => true]);
                  echo $this->Form->input('payment_mode', ['options' => ['Cash', 'Card']]);
                  echo $this->Form->input('card_number', ['templates' => ['inputContainer' => '<div class="row"><div id="div_card_number" class="input {{type}}{{required}} col-md-6">{{content}}</div>', 'inputContainerError' => '<div class="row"><div id="div_card_number" class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);
                  echo $this->Form->input('card_holder', ['templates' => ['inputContainer' => '<div id="div_card_holder" class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div id="div_card_holder" class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);
                  ?>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <?php
          echo $this->Form->input('status', ['type' => 'hidden', 'value' => 1]);
          ?>
          </div>
          <?php
            /*echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('code');
            echo $this->Form->input('no_of_persons');
            echo $this->Form->input('no_of_adults');
            echo $this->Form->input('no_of_childs');
            echo $this->Form->input('issued_by');
            echo $this->Form->input('member_id', ['options' => $members]);
            echo $this->Form->input('member_type');
            echo $this->Form->input('total_amount');
            echo $this->Form->input('hold_amount');
            echo $this->Form->input('balance');
            echo $this->Form->input('discount_code');
            echo $this->Form->input('discount_amount');
            echo $this->Form->input('payment_mode');
            echo $this->Form->input('card_number');
            echo $this->Form->input('card_holder');
            echo $this->Form->input('status');*/
          ?>
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
  $(function () {

    //alert($("#property-id").val());
    //getTicketCode($("#property-id").val());
    getTodayPrice($("#property-id").val());

    jQuery('#single_member_selector').hide();

    jQuery('#is-member').change(function(){
      if(jQuery(this).is(':checked')){
        jQuery('#single_member_selector').show();
      } else {
        jQuery('#single_member_selector').hide();
      }
    })

    jQuery('#total-amount').attr('readonly', true);
    jQuery('#hold-amount').attr('readonly', true);
    jQuery('#balance').attr('readonly', true);

    jQuery('#no-of-persons').blur(function(){
      if(jQuery(this).val() < 1 || jQuery(this).val() > 50){
        jQuery(this).val(1);
        jQuery(this).focus();
      }
      getTodayPrice($("#property-id").val());
    })

    function getTicketCode(propertyId){
      //alert("get belt code");
      var postData = {
          "property_id":propertyId
      };
      $.ajax({
          url: "<?=DEFAULT_URL?>waterpark-settings/getticketcodebyproperty/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            console.log(data);
            if(data === 'false'){

              /*alert('No rates available for this room');
              jQuery('#room_checkbox_'+roomID).attr("checked", false);
              jQuery('#select_plan_'+roomID).html('');*/

            } else {

              jQuery('#code').val(data);
              
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    }

    function getTodayPrice(propertyId){
      //alert("get belt code");
      var postData = {
          "property_id":propertyId
      };
      $.ajax({
          url: "<?=DEFAULT_URL?>waterpark-prices/gettodayprice/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            data = jQuery.parseJSON(data);
            console.log(data);

            if(data === 'false'){

              alert('No rates available for Today');
              /*alert('No rates available for this room');
              jQuery('#room_checkbox_'+roomID).attr("checked", false);
              jQuery('#select_plan_'+roomID).html('');*/

            } else {
              console.log(data.total_price);
              console.log(data.ticket_price);

              var total_amount = data.total_price * jQuery('#no-of-persons').val();
              console.log(total_amount);
              var total_ticket_price = data.ticket_price * jQuery('#no-of-persons').val();
              console.log(total_ticket_price);
              var balance = total_amount - total_ticket_price;
              console.log(balance);
              var net_amount = total_amount - jQuery('#discount-amount').val();
              console.log(net_amount);

              jQuery('#total-amount').val(total_amount);
              jQuery('#balance').val(balance);
              jQuery('#net-amount').val(net_amount);
              
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    }

    jQuery('#discount-amount').change(function(){
      var net_amount = jQuery('#total-amount').val() - jQuery('#discount-amount').val();
      console.log(net_amount);

      jQuery('#net-amount').val(net_amount);
    });

    $("#property-id").attr('disabled', true);

    /*$("#property-id").change(function(){
      getTicketCode($(this).val());
    });*/

    $('#mobileno').change(function(){
      var mobile_number = jQuery(this).val();
      var postData = {
          "mobile":mobile_number
      };
      $.ajax({
          url: "<?=DEFAULT_URL?>members/getmemberbymobile/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            console.log(data);
            if(data == 'null'){

              jQuery('#is-member').attr("checked", false);
              jQuery('#single_member_selector').hide();
              jQuery('#member-id-show').val('');
              jQuery('#member-id').val('');
              jQuery('#member-type').val('');

            } else {
              if (confirm("There is already member/guest using this mobile number"))
              {
                  console.log(data);
                  
                  var data = $.parseJSON(data);
                  console.log(data);
                  //fetchMemberFields(data, 'mobile');
                  jQuery('#is-member').attr("checked", true);
                  jQuery('#single_member_selector').show();
                  jQuery('#member-id-show').val(data.id);
                  jQuery('#member-id').val(data.id);
                  jQuery('#member-type').val(data.member_type);

              } else {
                  jQuery('#is-member').attr("checked", false);
                  jQuery('#single_member_selector').hide();
                  jQuery('#member-id-show').val('');
                  jQuery('#member-id').val('');
                  jQuery('#member-type').val('');
              } 
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    });


    if($('#payment-mode').val() == "1"){
      $('#div_card_number').show();
      $('#div_card_holder').show();
    } else {
      $('#div_card_number').hide();
      $('#div_card_holder').hide();        
    }

    $("#payment-mode").change(function(){
      //alert($(this).val());
      if($('#payment-mode').val() == "1"){
        $('#div_card_number').show();
        $('#div_card_holder').show();
      } else {
        $('#div_card_number').hide();
        $('#div_card_holder').hide();        
      }
    });

  });
</script>
<?php $this->end(); ?>