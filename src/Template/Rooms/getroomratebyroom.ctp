<?php
$total_room_rate = count($roomrate->toArray());

if($total_room_rate > 0){
	echo '<select name="checkin_rooms_rates['.$row_id.'][room_rate_id]" class="roomratebyplan" id="roomratebyplan_'.$room->id.'">';
	echo '<option value="">Select Plan</option>';
	foreach ($roomrate as $key => $value) {
		echo '<option value="'.$value->id.'">'.$value->room_plan->name.' - '.$value->rate.'</option>';
	}
	echo '</select>';
	exit;
} else {
	echo 'null';exit;
}