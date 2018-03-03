<label>Select Rooms</label><br>
<?php
//pr($rooms_for_rack->toArray());
foreach ($rooms_for_rack as $room_key => $room_data) {
	
	//if($room_key % 4 == 0){ echo '<div class="row">'; }

	?>
	 <input type="checkbox" id="room_checkbox_<?=$room_data->id?>" name="checkin_rooms_rates[<?=$room_key?>][room_id]" value="<?=$room_data->id?>" class="room-checkbox" /><?=$room_data->number.' - '.$room_data->code?><span data-row="<?=$room_key?>" id="select_plan_<?=$room_data->id?>"></span><span data-row="<?=$room_key?>" id="select_adult_child_<?=$room_data->id?>"></span><br>
    <?php

    //if($room_key % 4 == 3){ echo '</div>'; }
}