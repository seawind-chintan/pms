<section class="content-header">
  <h1>
    Reservation
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
        <?= $this->Form->create($reservation, array('role' => 'form')) ?>
          <div class="box-body">
            <legend class="col-form-label col-md-12 pt-0">Room Details<span class="pull-right"><?php
            
            $total_guests = (int) $wizardData['step1']['no_of_adult'] + (int) $wizardData['step1']['no_of_child'];
            $total_guests_title = ((!empty($wizardData['step1']['no_of_child'])) ? $wizardData['step1']['no_of_adult'].' Adult(s),'.$wizardData['step1']['no_of_child'].' Child(s)' : $wizardData['step1']['no_of_adult'].' Adult(s)' );
            

            $total_night_title = date('d-m-Y', strtotime($wizardData['step1']['start_date'])).' to '.date('d-m-Y', strtotime($wizardData['step1']['end_date']));
            $date1 = new DateTime($wizardData['step1']['start_date']);
            $date2 = new DateTime($wizardData['step1']['end_date']);
            // this calculates the diff between two dates, which is the number of nights
            $numberOfNights= $date2->diff($date1)->format("%a");

            echo ucwords($wizardData['step1']['reservation_type']).' for <b title="'.$total_night_title.'">'.$numberOfNights.'</b> nights , <b title="'.$total_guests_title.'">'.$total_guests.'</b> guest(s)';
            ?></span></legend><hr>
            <div class="col-md-12">
            <input type="hidden" name="total_guests" id="total_guests" value="<?=$total_guests?>" />
            <h4 class="box-title">Select Rooms</h4>
              <?php
              //pr($rooms->toArray());
              foreach ($rooms as $roomKey => $roomData)
              {
              ?>
              <div class="box box-solid">
                <div class="box-body">
                    <div class="media">
                        <div class="media-left">
                          <input type="hidden" name="select_room_rate[]" id="select_room_rate_<?=$roomData->id?>" value="<?= $roomData->rate ?>" disabled="disabled" />
                          <input type="checkbox" name="room_rates[]" data-room-rate="<?=$roomData->id?>"  class="select-room-check" value="<?=$roomData->id?>">
                        </div>
                        <div class="media-body">
                            <div class="clearfix">
                                <p class="pull-right">
                                  <button type="button" class="btn btn-success"><i class="fa fa-rupee"></i><?= $roomData->rate ?> per night</button>
                                </p>

                                <h4 style="margin-top: 0"><?= $roomData->room_type->name ?> ─ <?= $roomData->room_occupancy->name ?> Occupancy ─ <?= $roomData->room_plan->name ?></h4>

                                <?php
                                //pr($roomData);
                                ?>
                                <select name="select_room_adult[]" id="select_room_adult_<?=$roomData->id?>" disabled="disabled">
                                  <?php
                                  $max_adult_for_booking = (($roomData->max_adult < $total_guests ) ? $roomData->max_adult : $total_guests);
                                  for ($ad_i=$roomData->min_adult; $ad_i <= $max_adult_for_booking; $ad_i++) { 
                                    echo '<option value="'.$ad_i.'">'.$ad_i.'</option>';
                                  }
                                  ?>
                                </select>

                                <select name="select_room_child[]" id="select_room_child_<?=$roomData->id?>" disabled="disabled">
                                  <?php
                                  $max_child_for_booking = (($roomData->max_child < $total_guests ) ? $roomData->max_child : $total_guests);
                                  for ($ch_i=0; $ch_i <= $max_child_for_booking; $ch_i++) { 
                                    echo '<option value="'.$ch_i.'">'.$ch_i.'</option>';
                                  }
                                  ?>
                                </select>

                                <select name="select_room_number[]" id="select_room_number_<?=$roomData->id?>" disabled="disabled">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select>

                                

                               <!--  <p>This is test room details for room xyz... bla bla bla ...</p>
                                <p style="margin-bottom: 0" id="room_price_<?=$roomData->id?>">
                                    <?php echo $this->Form->input('room_plan_id', ['type' => 'checkbox']); ?><i class="fa fa-rupee"></i> 853+ purchases
                                </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
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
$this->Html->script([
  'AdminLTE./plugins/jQuery/jquery-2.2.3.min',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script type="text/javascript">
  /*jQuery('.select-room-btn').click(function(){
    var dataProperty = jQuery(this).attr('data-property');
    var dataType = jQuery(this).attr('data-type');
    var dataOccupancy = jQuery(this).attr('data-occupancy');
    var dataRoom = jQuery(this).attr('data-room');

    var postData = {
              "property_id":dataProperty,
              "room_type_id":dataType,
              "room_occupancy_id":dataOccupancy
          };

    $.ajax({
        url: "<?=DEFAULT_URL?>room-rates/getspecificrates/",
        type: "POST",
        data: {myData:postData},
        success: function(data)
         {
          //alert(data);
          jQuery('#room_price_'+dataRoom).html(data);
         },
    });
  });*/

  jQuery('.select-room-check').change(function(){
    var roomRateId = jQuery(this).attr('data-room-rate');
    if(jQuery(this).prop( "checked" )){
      jQuery('#select_room_adult_'+roomRateId).attr('disabled', false);
      jQuery('#select_room_child_'+roomRateId).attr('disabled', false);
      jQuery('#select_room_number_'+roomRateId).attr('disabled', false);
      jQuery('#select_room_rate_'+roomRateId).attr('disabled', false);
    } else {
      jQuery('#select_room_adult_'+roomRateId).attr('disabled', 'disabled');
      jQuery('#select_room_child_'+roomRateId).attr('disabled', 'disabled');
      jQuery('#select_room_number_'+roomRateId).attr('disabled', 'disabled');
      jQuery('#select_room_rate_'+roomRateId).attr('disabled', 'disabled');
    }
  });
</script>
<?php $this->end(); ?>