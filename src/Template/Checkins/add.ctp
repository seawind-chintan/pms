<section class="content-header">
  <h1>
    Checkin
    <small><?= __('Add') ?></small>
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
        <?= $this->Form->create($checkin, array('role' => 'form')) ?>
          <div class="box-body">
          <div class="col-md-6">
          <?php
          //pr($_POST);
            echo $this->Form->input('custom_member_type', ['label' => 'Member Type', 'options' => [0 => 'New Guest/Member', 1 => 'Existing Guest/Member']]);
            echo $this->Form->input('member.member_type', ['type' => 'hidden', 'value' => 'guest']);
            echo '<div class="col-md-4">'.$this->Form->input('member.code').'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.mobile').'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.email').'</div>';
            echo $this->Form->input('member.application_no');
            if(!empty($_POST['member']['id'])){
              echo $this->Form->input('member.id', ['type' => 'hidden', 'value' => $_POST['member']['id']]);
            } else {
              echo $this->Form->input('member.id', ['type' => 'hidden', 'disabled' => 'disabled']);
            }
            echo '<div class="col-md-4">'.$this->Form->input('member.first_name').'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.last_name').'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.nickname').'</div>';
            echo $this->Form->input('member.cor_address', ['label' => 'Address']);
            echo '<div class="col-md-4">'.$this->Form->input('member.cor_city', ['label' => 'City', 'options' => $cities]).'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.cor_state', ['label' => 'State', 'options' => $states]).'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.cor_country', ['label' => 'Country', 'options' => $countries]).'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.cor_pincode', ['label' => 'Pincode']).'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.phone').'</div>';
            echo '<div class="col-md-4">'.$this->Form->input('member.pancard').'</div>';
            echo $this->Form->input('member.gender');
            echo $this->Form->input('member.birth_date', ['empty' => true, 'default' => '', 'class' => 'datepicker form-control', 'type' => 'text']);
            echo $this->Form->input('member.status', ['type' => 'hidden', 'value' => 1]);
            //echo $this->Form->input('member.parent', ['type' => 'hidden', 'value' => $this->Auth->user('id')]);
            ?>
          </div>
          <div class="col-md-6">
          <?php
            echo $this->Form->input('arrival_date_time', ['value' => date('Y-m-d H:i:s'), 'readonly' => 'true']);
            echo $this->Form->input('no_of_adult');
            echo $this->Form->input('no_of_child');
            echo $this->Form->input('arrival_from');
            echo $this->Form->input('destination');
            echo $this->Form->input('purpose_of_visit');
            echo $this->Form->input('travel_agent');
            echo $this->Form->input('remarks');
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo '<div id="rooms_checkboxes"></div>';
            echo $this->Form->input('dept_date_time', ['class' => 'datepicker']);
            echo $this->Form->input('status', ['type' => 'hidden', 'value' => 1]);
          ?>
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

        <?php
$this->Html->css([
    'AdminLTE./plugins/datepicker/datepicker3',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/input-mask/jquery.inputmask',
  'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
  'AdminLTE./plugins/datepicker/bootstrap-datepicker',
  'AdminLTE./plugins/datepicker/locales/bootstrap-datepicker.pt-BR',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {
    //Datemask mm/dd/yyyy
    $(".datepicker")
        .inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"})
        .datepicker({
            language:'en',
            format: 'mm/dd/yyyy'
        });


    var propertyId = jQuery('#property-id').val();
    var postData = {
        "property_id":propertyId
    };

    $.ajax({
        url: "<?=DEFAULT_URL?>rooms/getroomsbyproperty/",
        type: "POST",
        data: {myData:postData},
        success: function(data)
         {
          //alert(data);
          jQuery('#rooms_checkboxes').html(data);
         },
    });

    jQuery(document).on('change', '.room-checkbox', function() {
        if(jQuery(this).is(":checked")) {
            
            var room_id = jQuery(this).val();
            var row_id = jQuery('#select_plan_'+room_id).attr('data-row');
            var postData = {
                "room_id":room_id,
                "row_id":row_id
            };
            $.ajax({
                url: "<?=DEFAULT_URL?>rooms/getroomratebyroom/",
                type: "POST",
                data: {myData:postData},
                success: function(data)
                 {
                  console.log(data);
                  if(data === 'false'){

                    //resetFields('mobile');
                    //alert(room_id);
                    //var returnVal = confirm("Are you sure?");
                    alert('No rates available for this room');
                    jQuery('#room_checkbox_'+room_id).attr("checked", false);
                    jQuery('#select_plan_'+room_id).html('');

                  } else {

                    jQuery('#select_plan_'+room_id).html(data);
                    
                  }
                  //jQuery('#roomrack_display').html(data);
                 },
            });
        } else {
          var room_id = jQuery(this).val();
          alert(jQuery(this).is(":checked"));
          jQuery('#select_plan_'+room_id).html('');
          jQuery('#select_adult_child_'+room_id).html('');
        }
    });

    jQuery(document).on('change', '.roomratebyplan', function() {
        alert(jQuery(this).val());
        var roomrate_id = jQuery(this).val();
        var room_id = jQuery(this).attr('id');
        room_id = room_id.substring(15);
        console.log(room_id);
        var row_id = jQuery('#select_adult_child_'+room_id).attr('data-row');
        var postData = {
            "roomrate_id":roomrate_id,
            "row_id":row_id
        };
        $.ajax({
            url: "<?=DEFAULT_URL?>rooms/getadultbyroomrate/",
            type: "POST",
            data: {myData:postData},
            success: function(data)
             {
              console.log(data);
              if(data === 'false'){

                //resetFields('mobile');
                //alert(room_id);
                //var returnVal = confirm("Are you sure?");
                alert('No rates available for this room');
                jQuery('#select_adult_child_'+room_id).html('');

              } else {

                jQuery('#select_adult_child_'+room_id).html(data);
                
              }
              //jQuery('#roomrack_display').html(data);
             },
        });
    });

    function resetFields(fetchfrom="mobile")
      {
          jQuery('#member-id').attr('disabled', true);
          jQuery('#member-application-no').attr('readonly', false);
          jQuery('#member-first-name').attr('readonly', false);
          jQuery('#member-last-name').attr('readonly', false);
          jQuery('#member-nickname').attr('readonly', false);
          jQuery('#member-cor-address').attr('readonly', false);
          jQuery('#member-cor-city').attr('readonly', false);
          jQuery('#member-cor-state').attr('readonly', false);
          jQuery('#member-cor-country').attr('readonly', false);
          jQuery('#member-cor-pincode').attr('readonly', false);
          jQuery('#member-pancard').attr('readonly', false);
          jQuery('#member-gender').attr('readonly', false);
          jQuery('#member-birth-date').attr('readonly', false);
          jQuery('#member-phone').val('').attr('readonly', false);
          if(fetchfrom == 'email'){
            jQuery('#member-email').attr('readonly', false);
          } else {
            //jQuery('#member-email').val('').attr('readonly', false);
          }
          if(fetchfrom == 'mobile'){
            jQuery('#member-mobile').attr('readonly', false);
          } else {
            //jQuery('#member-mobile').val('').attr('readonly', false);
          }
          if(fetchfrom == 'code'){
            jQuery('#member-code').attr('readonly', false);
          } else {
            //jQuery('#member-code').val('').attr('readonly', false);
          }
          jQuery('#custom-member-type').val(0);
      }

      function fetchMemberFields(data, fetchfrom='mobile'){
          jQuery('#member-id').val(data.id).attr('disabled', false);
          jQuery('#member-application-no').val(data.application_no).attr('readonly', true);
          jQuery('#member-first-name').val(data.first_name).attr('readonly', true);
          jQuery('#member-last-name').val(data.last_name).attr('readonly', true);
          jQuery('#member-nickname').val(data.nick_name).attr('readonly', true);
          jQuery('#member-cor-address').val(data.cor_address).attr('readonly', true);
          jQuery('#member-cor-city').val(data.cor_city).attr('readonly', true);
          jQuery('#member-cor-state').val(data.cor_state).attr('readonly', true);
          jQuery('#member-cor-country').val(data.cor_country).attr('readonly', true);
          jQuery('#member-cor-pincode').val(data.cor_pincode).attr('readonly', true);
          jQuery('#member-pancard').val(data.pancard).attr('readonly', true);
          jQuery('#member-gender').val(data.gender).attr('readonly', true);
          jQuery('#member-birth-date').val(data.birth_date).attr('readonly', true);
          if(fetchfrom == 'email'){
            jQuery('#member-email').val(data.email).attr('readonly', false);
          } else {
            jQuery('#member-email').val(data.email).attr('readonly', true);
          }

          if(fetchfrom == 'code'){
            jQuery('#member-code').val(data.code).attr('readonly', false);
          } else {
            jQuery('#member-code').val(data.code).attr('readonly', true);
          }
          jQuery('#member-phone').val(data.phone).attr('readonly', true);
          if(fetchfrom == 'mobile'){
            jQuery('#member-mobile').val(data.mobile).attr('readonly', false);
          } else {
            jQuery('#member-mobile').val(data.mobile).attr('readonly', true);
          }
          jQuery('#custom-member-type').val(1);
      }

    $('#member-mobile').change(function(){
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

              resetFields('mobile');

            } else {
              if (confirm("There is already member/guest using this mobile number"))
              {
                  console.log(data);
                  
                  var data = $.parseJSON(data);
                  console.log(data);
                  fetchMemberFields(data, 'mobile');

              } else {
                  jQuery('#member-mobile').val('');
                  jQuery('#member-mobile').focus();
              } 
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    });

    $('#member-email').change(function(){
      var email = jQuery(this).val();
      var postData = {
          "email":email
      };
      $.ajax({
          url: "<?=DEFAULT_URL?>members/getmemberbyemail/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            console.log(data);
            if(data == 'null'){

              resetFields('email');

            } else {
              if (confirm("There is already member/guest using this email"))
              {
                  console.log(data);
                  
                  var data = $.parseJSON(data);
                  console.log(data);
                  fetchMemberFields(data, 'email');

              } else {
                  jQuery('#member-email').val('');
                  jQuery('#member-email').focus();
              } 
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    });


    jQuery('#property-id').change(function(){
      var propertyId = jQuery(this).val();

      var postData = {
          "property_id":propertyId
      };

      $.ajax({
          url: "<?=DEFAULT_URL?>rooms/getroomsbyproperty/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            //alert(data);
            jQuery('#rooms_checkboxes').html(data);
           },
      });
    });

  });
</script>
<?php $this->end(); ?>
        