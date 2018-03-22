<?php
$item_data = json_decode($menulist);
echo $this->Form->input('waterpark_kot_items.rate',['readonly'=>true,'value'=>$item_data->price]);
?>