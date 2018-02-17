
<?php

//echo $this->Form->input('user_id', ['options' => $users]);

$service_array = array();

if(!empty($userService->id))
{
    echo $this->Form->input('id',['type'=>'hidden','value'=>$userService->id]);
    $service_array = explode(',', $userService->services);
}

/* */

echo '<label for="user-id">Services</label>';
echo '<br>';

foreach ($services_arr as $k => $service_txt) {

    $t = 0;
    if (!empty($service_txt['child'])) {
        //echo '<br>';
        echo $service_txt['name'];

        foreach ($service_txt['child'] as $sub_id => $sub_service_txt) {
            $checked = '';
            if (!empty($service_array) && in_array($sub_id, $service_array))
                $checked = 'checked';

            echo $this->Form->input('services[]', array(
                'label' => $sub_service_txt['name'],
                'type' => 'checkbox',
                'id' => 'textbox_' . $sub_id,
                'value' => $sub_service_txt['id'],
                $checked

            ));
        }
    }
}
?>
