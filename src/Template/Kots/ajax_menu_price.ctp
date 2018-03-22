<?php
$item_data = json_decode($menulist);
echo $this->Form->input('kot_items.rate',['readonly'=>true,'value'=>$item_data->price]);
?>