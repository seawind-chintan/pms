<?php
//pr($state);
$cities = $state->cities;
$citiesoptions = array();
foreach ($cities as $citykey => $city) {
  $citiesoptions[$city->id] = $city->name;
}
$selected = array();
if(isset($table_field) && $table_field!='')
    $pass_field = $table_field;
else
    $pass_field = 'userdetail.city';

echo $this->Form->input($pass_field, array('label'=>'Select City','class' => 'form-control', 'options' => $citiesoptions, 'selected' => $selected));