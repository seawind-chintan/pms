<?php
//pr($roomrate->first());
$roomrate = $roomrate->first();
//pr($roomrate);exit;
//$total_room_rate = count($roomrate->toArray());
echo '<select name="checkin_rooms_rates['.$row_id.'][no_of_adult]" class="adultbyroomrate">';
	echo '<option value="">Select Adult</option>';
for ($iadult=$roomrate->min_adult; $iadult <= $roomrate->max_adult ; $iadult++) { 
	echo '<option value="'.$iadult.'">'.$iadult.'</option>';
}
echo '</select>';


echo '<select name="checkin_rooms_rates['.$row_id.'][no_of_child]" class="childbyroomrate">';
	echo '<option value="">Select Child</option>';
for ($ichild=0; $ichild <= $roomrate->max_child ; $ichild++) { 
	echo '<option value="'.$ichild.'">'.$ichild.'</option>';
}
echo '</select>';
	exit;