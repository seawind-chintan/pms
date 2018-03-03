<?php
//pr($rooms_for_rack->toArray());
foreach ($rooms_for_rack as $room_key => $room_data) {
	
	if($room_key % 4 == 0){ echo '<div class="row">'; }

	?>
	<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box room-box" style="cursor: pointer;">
            <?php
            switch ($room_data->room_status_id) {
              case 1:
                $status_color = 'bg-aqua';
                break;

              case 3:
                $status_color = 'bg-yellow';
                break;

              case 5:
                $status_color = 'bg-green';
                break;
              
              default:
                $status_color = 'bg-aqua';
                break;
            }
            ?>
            <span class="info-box-icon <?=$status_color?>"><i class="ion ion-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo $room_data->number.' - '.$room_data->code; ?></span>
              <span class="info-box-number"><?php echo $room_data->room_type->name; ?></span>
              <span class="info-box-number"><?php echo $room_data->room_occupancy->name; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    <?php

    if($room_key % 4 == 3){ echo '</div>'; }
}