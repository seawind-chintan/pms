<?php
//pr($state);
$cities = $state->cities;
$citiesoptions = array();
foreach ($cities as $citykey => $city) {
  $citiesoptions[$city->id] = $city->name;
}
$selected = array();
echo $this->Form->input('userdetail.city', array('label'=>'Select Country','class' => 'form-control', 'options' => $citiesoptions, 'selected' => $selected));