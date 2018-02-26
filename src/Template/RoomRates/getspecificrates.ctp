<?php
if(count($roomRates) > 0)
{
	$selectBoxHtml = '<div class="form-group input select">
				<label for="room-plan-id">Select Plan</label>
				<select name="room_plan_id" class="form-control" id="room-plan-id">';

	foreach ($roomRates as $rate_key => $rate) {
		//pr($rate);exit;
		//$roomsoptions[$rate->room_plan->id] = $rate->room_plan->name.' - '.$rate->rate;

		$selectBoxHtml .= '<option price="'.$rate->rate.'" value="'.$rate->room_plan->id.'">'.$rate->room_plan->name.'</option>';
	}

	$selectBoxHtml .= '</select></div>';

	echo $selectBoxHtml;exit;
}
else
{
	echo '<b>No Plans Available for this room, please select other !</b>';exit;
}