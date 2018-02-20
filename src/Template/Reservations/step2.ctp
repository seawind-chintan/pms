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
            echo ucwords($wizardData['step1']['reservation_type']).' for date <b>'.date('d-m-Y', strtotime($wizardData['step1']['start_date'])).'</b> to <b>'.date('d-m-Y', strtotime($wizardData['step1']['end_date'])).'</b> , <b title="'.$total_guests_title.'">'.$total_guests.'</b> guests';
            ?></span></legend><hr>
            <div class="col-md-12">
            <h4 class="box-title">Select Rooms</h4>
              <?php
              pr($rooms->toArray());
              foreach ($rooms as $roomKey => $roomData)
              {
              ?>
              <div class="box box-solid">
                <div class="box-body">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                        <?= $roomData->code ?> - <?= $roomData->number ?>
                    </h4>
                    <div class="media">
                        <div class="media-left">
                          <img src="https://adminlte.io/uploads/images/free_templates/creative-tim-material-angular.png" alt="Material Dashboard Pro" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                        </div>
                        <div class="media-body">
                            <div class="clearfix">
                                <p class="pull-right"><button type="button" class="btn btn-success select-room-btn" data-property="<?=$wizardData['step1']['property_id']?>" data-type="<?=$roomData->room_type->id?>" data-occupancy="<?=$roomData->room_occupancy->id?>">Select</button></p>

                                <h4 style="margin-top: 0"><?= $roomData->room_type->name ?> ─ <?= $roomData->room_occupancy->name ?> Occupancy</h4>

                                <p>This is test room details for room xyz... bla bla bla ...</p>
                                <p style="margin-bottom: 0">
                                    <i class="fa fa-rupee"></i> 853+ purchases
                                    <i class="fa fa-rupee"></i> 853+ purchases
                                </p>
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
  jQuery('.select-room-btn').click(function(){
    alert(jQuery(this).attr('data-property'));
    var dataProperty = jQuery(this).attr('data-property');
    alert(jQuery(this).attr('data-type'));
    var dataType = jQuery(this).attr('data-type');
    alert(jQuery(this).attr('data-occupancy'));
    var dataOccupancy = jQuery(this).attr('data-occupancy');

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
          jQuery('#city-area').html(data);
         },
    });
  });
</script>
<?php $this->end(); ?>