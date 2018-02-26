<?php
//pr($rooms_for_rack->toArray());
foreach ($rooms_for_rack as $room_key => $room_data) {
	
	if($room_key % 4 == 0){ echo '<div class="row">'; }

	?>
	<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box room-box" style="cursor: pointer;">
            <span class="info-box-icon bg-aqua"><i class="ion ion-home"></i></span>

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